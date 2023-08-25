<?php

namespace App\Http\Controllers\Member;

use App\Models\Announcement;
use App\Models\AnnouncementLog;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Address;
use App\Models\PromotionOrdersLog;
use App\Models\PaymentSetting;
use App\Models\DeliverySetting;
use App\Models\CompanyInfo;
use App\Models\Ranking;
use App\Models\WalletHistory;
use App\Http\Middleware\CheckCartItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
Use Alert;
use Session;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckCartItem::class)->only('member.checkout');
    }

    public function dashboard()
    {

        $user = Auth::user();
        $user->url = url('') .'/register/' . $user->referrer_id;
        $referral = User::where('upline_id', Auth::id())->count();

        $now = Carbon::now();

        $hasValidPromotion = PromotionOrdersLog::where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->exists();
        // Construct the query based on the existence of valid promotion records
        $next_rank = Ranking::where('level', $user->rank->level + 1)
            ->where(function ($query) use ($hasValidPromotion) {
                if ($hasValidPromotion) {
                    $query->whereIn('level', [1, 2, 3, 4, 5])
                        ->where('category', 'promotion');
                } else {
                    $query->whereIn('level', [1, 2, 3, 4, 5])
                        ->where('category', 'normal');
                }
            })
            ->first();

        $announcements = [];
        if (Session::has('show_announcement')) {
            $announcements = Announcement::query()->where('status', 1)->where('popup', true)->latest()->get();
            if ($announcements->isNotEmpty()) {
                $popup_once_announcements = $announcements->where('popup_once', true);
                if ($popup_once_announcements->isNotEmpty()) {
                    $ids = $popup_once_announcements->pluck('id');

                    $readAnnouncements = AnnouncementLog::where('user', $user->id)->whereIn('announcementId', $ids)->pluck('announcementId');

                    $announcements = $announcements->whereNotIn('id', $readAnnouncements);

                    $unreadAnnouncementsIds = $popup_once_announcements->whereNotIn('id', $readAnnouncements)->pluck('id');

                    foreach ($unreadAnnouncementsIds as $id) {
                        AnnouncementLog::create(['user' => $user->id, 'announcementId' => intval($id)]);
                    }
                }
            }
        }
        // dd($announcements);
        return view('member.dashboard', compact('user', 'next_rank', 'referral', 'announcements'));
    }

    public function announcement() {
        $announcements = Announcement::where('status', 1)->get();
        return view('member.announcement', compact('announcements'));
    }

    public function cart() {
        $cart = Cart::where('user_id', Auth::id())
        ->first();
        $cartItems = CartItem::with('cart', 'product')
        ->whereHas('cart', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->latest()
        ->get();

        $user = Auth::user();
        if ($user->rank_id == 2) {
            $member_discount_amount = 10;
        } elseif ($user->rank_id == 3) {
            $member_discount_amount = 35;
        } elseif ($user->rank_id == 4) {
            $member_discount_amount = 45;
        } elseif ($user->rank_id == 5) {
            $member_discount_amount = 50;
        } else {
            $member_discount_amount = 0; // Handle other ranks if needed
        }
        $subtotal = 0;

        $disAmt = $cartItems->sum('discount_price');

        return view('member.cart', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'cart' => $cart,
            'discountAmt' => $member_discount_amount,
            'disAmt' => $disAmt
        ]);
    }

    public function checkout()
    {
        $payment_methods = PaymentSetting::whereIn('id', [1, 2, 3])->get();
        $payment_selfpick = PaymentSetting::get();
        $delivery_methods = DeliverySetting::get();
        $default_address = Address::where('id', 1)->first();
        $shipping_address = Address::where('user_id', auth()->user()->id)->get();
        $companyInfo = CompanyInfo::first();

        $user = User::with('cart.items', 'address.shippingCharge')
            ->where('id', Auth::id())
            ->whereHas('address', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->first();

        // $shipping_methods = DeliverySetting::

        $cartItems = $user->cart ? $user->cart->items : collect();

        // dd($cartItems);

        $subtotal = 0;
        $totalDiscount = 0; // Initialize totalDiscount variable outside the loop
        $discountedPrice = 0;
        $discount = 0;
        $product_price = 0;
        $discount_percent_amount = 0;
        $total_discounted = 0;

        foreach ($cartItems as $item) {
            if ($item->product->discount == 0) {
                $product_price = $item->product->price;

                if ($user->rank_id == 2) {
                    $member_discount_amount = 10;
                } elseif ($user->rank_id == 3) {
                    $member_discount_amount = 35;
                } elseif ($user->rank_id == 4) {
                    $member_discount_amount = 45;
                } elseif ($user->rank_id == 5) {
                    $member_discount_amount = 50;
                } else {
                    $member_discount_amount = 0; // Handle other ranks if needed
                }

                $discount_percent_amount = $member_discount_amount * ($product_price / 100);
                $discounted_product_price = $product_price - $discount_percent_amount;

                // Accumulate values for each item
                $subtotal += $discounted_product_price * $item->quantity;
                $total_discounted += $discount_percent_amount * $item->quantity;
            } else {

                if ($user->rank_id == 2) {
                    $member_discount_amount = 10;
                } elseif ($user->rank_id == 3) {
                    $member_discount_amount = 35;
                } elseif ($user->rank_id == 4) {
                    $member_discount_amount = 45;
                } elseif ($user->rank_id == 5) {
                    $member_discount_amount = 50;
                } else {
                    $member_discount_amount = 0; // Handle other ranks if needed
                }

                $discountedPrice = $item->product->price - ($item->product->price * ($item->product->discount / 100));
                $discount = $item->product->price * ($item->product->discount / 100);

                // Accumulate values for each item
                $totalDiscount += $discount * $item->quantity;
                $subtotal += $discountedPrice * $item->quantity;

                $product_price = $item->product->price;
            }
        }



        // Calculate the total price with discount
        // $totalPriceWithDiscount = $subtotal - $totalDiscount;

        // ... (existing code)

        if ($cartItems->count() > 0) {
            return view('member.checkout', [
                'cartItems' => $cartItems,
                'product_price' => $product_price,
                'user' => $user,
                'payment_methods' => $payment_methods,
                'delivery_methods' => $delivery_methods,
                'discount_percent_amount' => $discount_percent_amount,
                'subtotal' => $subtotal,
                'discountedPrice' => $discountedPrice,
                'discount' => $discount,
                'totalDiscount' => $totalDiscount,
                'total_discounted' => $total_discounted,
                'default_address' => $default_address,
                'payment_selfpick' => $payment_selfpick,
                'shipping_address' => $shipping_address,
                'member_discount_amount' => $member_discount_amount,
                'companyInfo' => $companyInfo
            ]);
        }

        // If the user does not meet the conditions, redirect to the cart page with a message
        return redirect()->route('member.cart')->with('title', 'Error: No items in cart')->with('message', 'You need to have items in your cart to proceed to checkout.')->with('from_modal', true);
    }

    // public function createOrder(Request $requesst)
    // {
    //     dd($request->all());

    //     return redirect()->back();
    // }

    public function commission() {
        return view('member.commission');
    }
    public function bonus() {
        return view('member.bonus');
    }
    // public function internalTransferHistory() {
    //     return view('member.internal_transfer_history');
    // }
    // public function internalTransferNew() {
    //     return view('member.internal_transfer_new');
    // }



    public function pendingTopup() {
        return view('member.pending_topup');
    }
    public function topupHistory() {
        return view('member.topup_history');
    }
    public function cashWallet() {

        $user = Auth::user();

        $cashWallets = WalletHistory::where('wallet_type', 'Cash Wallet')->where('user_id', $user->id)->get();
        // dd($cashWallets);
        return view('member.cash_wallet', [
            'cashWallets' => $cashWallets
        ]);
    }
    public function productWallet() {
        return view('member.product_wallet');
    }
    public function memberDetail(User $user) {

        return view('member.member_detail', compact('user'));
    }
    public function memberListing() {
        $members = User::where('upline_id', Auth::id())->get();

        return view('member.member_listing', compact('members'));
    }
    public function memberNetworkTree(Request $request) {

        // $user = Auth::user();
        $users = User::query();
        
        $code = $request->code;

        if($code) {
            $users = $users->where('hierarchyList', 'like', '%-' . Auth::id() . '-%');
        //    dd($users);
            if($code) {
                $users = $users->where('referral_id', '=', $code);
                // dd($users);
            }
        }
        else
        {
            $users = $users->where('id', Auth::id());
        }
        $users = $users->get();

        return view('member.member_network_tree', [
            'users' => $users,
        ]);
    }
    public function networktree(Request $request)
    {

        $code = $request->code;
        // dd($code);
        $users = User::query();
        if($code) {
            $users = $users->where('hierarchyList', 'like', '%-' . Auth::id() . '-%');
        //    dd($users);
            if($code) {
                $users = $users->where('referrer_id', '=', $code);
                // dd($users);
            }
        }
        else
        {
            $users = $users->where('id', Auth::id());
        }
        $users = $users->get();

        return view('member.network.network-tree', [
            'users' => $users,
        ]);
    }
    public function pendingOrder() {
        $orders = Order::with(['user', 'orderItems', 'orderItems.product'])->where('user_id', Auth::id())->get();
        // dd($orders);
        return view('member.order_pending', [
            'orders' => $orders,
        ]);
    }
    public function cancelorder(Order $order)
    {
        // dd($order->status);

        if($order->status == 1 || $order->status == 2)
        {
            $order->update([
                'status' => 5,
            ]);

            Alert::success('Success', 'Cancelled the shipment');
            return redirect()->back();
        }else{
            Alert::error('Fail', 'You cannot cancel the shipment');
            return redirect()->back();
        }
    }

    // public function orderHistory() {
    //     return view('member.order_history');
    // }
    public function productList() {
        // ProductController
    }
    public function productDetail() {
        // ProductController
    }



    // public function topupHistory() {
    //     return view('member.topup_history');
    // }
    // public function topupPending() {
    //     return view('member.topup_pending');
    // }

    // public function withdrawalHistory() {
    //     return view('member.withdrawal_history');
    // }
    // public function withdrawalPending() {
    //     return view('member.withdrawal_pending');
    // }

    // AJAX


    public function getCartRecords() {

        $cartRecords = Cart::where('user_id', Auth::id())->latest()->take(5)->get(); // Assuming your cart records are stored in the "carts" table

        return response()->json($cartRecords);
    }

    public function userprofile()
    {
        return view('member.profile.myprofile');
    }

    public function updateprofile(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();

        $user->update([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'contact' => $request->contact,
            'id_no' => $request->id_no,
            'bank_holder_name' => $request->holdername,
            'bank_acc_no' => $request->bankacc,
            'bank_ic' => $request->bankid,
        ]);

        // if($request->input('current_password') != null)
        // {
        //     $current = Auth::User()->password;
        //     if(hash::check($request->input('current_password'), $current))
        //     {
        //         $user_id = Auth::user()->id;
        //         $obj_user = User::find($user_id);
        //             if($request->input('new_password') == $request->input('confirm_password'))
        //             {
        //                 $obj_user->password = Hash::make($request->input('new_password'));
        //                 $obj_user->save();

        //                 Alert::success(trans('public.success'), trans('public.successful_updated_password'));
        //                 return redirect()->back();
        //             } else {
        //                 Alert::error(trans('public.failed'), trans('public.new_password_doesn\t_match_with_confirm_password'));
        //                 return redirect()->back();
        //             }
        //     } else {
        //         Alert::error(trans('public.failed'), trans('public.Incorrect_current_password'));
        //         return redirect()->back();
        //     }
        // }


        Alert::success('Success', 'Profile Updated');
        return redirect()->back();
    }
    public function updatepassword(Request $request)
    {
        // dd($request->all());
        $user = Auth::user()->password;

        Alert::success('Success', 'Password Updated');
        return redirect()->back();
    }

    public function checkUniqueFullName(Request $request)
    {
        $full_name = $request->input('full_name');
        $user = Auth::user();

        $isUnique = !User::where('full_name', $full_name)->where('id', '!=', $user->id)->exists();

        return response()->json(['unique' => $isUnique]);
    }

    public function checkUniqueEmail(Request $request)
    {
        $email = $request->input('email');
        $user = Auth::user();

        $isUnique = !User::where('email', $email)->where('id', '!=', $user->id)->exists();

        return response()->json(['unique' => $isUnique]);
    }

    public function checkCurrentPass(Request $request)
    {
        $currentPassword = $request->input('current_password');
        $user = Auth::user();

        // Check if the provided current password matches the user's actual password
        if (Hash::check($currentPassword, $user->password)) {
            return response()->json(['match' => true]);
        } else {
            return response()->json(['match' => false]);
        }
    }

    public function invoice(Order $order, Request $request)
    {
        // dd($order);
        $user = Auth::user();
        $invoice = Order::where('order_num', '=', $order->order_num)->where('user_id', $user->id)->first();

        // $orderItems = OrderItem::query()->join('products', 'order_items.product_id', '=', 'products.id')
        //                         ->where('order_num', '=', $order)
        //                         ->select('order_items.*', 'products.name_en as product_name_en', 'products.name_cn as product_name_cn')
        //                         ->get();
        $orderItems = OrderItem::where('order_num', $order->order_num)->with(['product'])->get();
        $companyInfo = CompanyInfo::get()->first();

        $pdf = PDF::loadView('member.orders..pdf.invoice', ['invoice' => $invoice, 'orderItems' => $orderItems, 'companyInfo' => $companyInfo]);
        return $pdf->download('invoice.pdf');
    }

    public function uploadpayment(Request $request,Order $order)
    {
        // dd($request->all());
        $request->validate([
            'payment_proof' => 'nullable|image|max:2048', // Adjust the allowed mime types and file size as needed
        ]);

        $imageName1 = null;
        if ($request->hasFile('payment_proof')){
            // dd($request->all());
            $imageName1 = time().'.'.$request->payment_proof->extension();
            $request->payment_proof->move(public_path('images/payment-proof'), $imageName1);

            $order->payment_proof = $imageName1;
            $order->status = 1;
            $order->save();

            Alert::success('Success', 'Uploaded the Payment Slip');
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function redeemCommission(Request $request)
    {
        $user = Auth::user();
        
        if($user->cash_wallet > 0 ) {
            $cashwallet_amount = $user->cash_wallet;

            $user->purchase_wallet += $cashwallet_amount;
            $user->cash_wallet = 0;
            $user->save();

            $wallet = new WalletHistory();
            $wallet->user_id =  $user->id;
            $wallet->wallet_type = 'Cash Wallet';
            $wallet->type = 'Redeem';
            $wallet->cash_in = null;
            $wallet->cash_out = $cashwallet_amount;
            $wallet->balance = $user->cash_wallet;
            $wallet->remarks = 'redeem';
            // dd($wallet);
            $wallet->save();

            Alert::success('Success', 'Redeemed the cash wallet');
            return redirect()->back();
        } else {
            Alert::error('Fail', 'you have no cash wallet balance');
            return redirect()->back();
        }

    }

    public function ShippingAddress()
    {
        return view('member.profile.shippingaddress');
    }

    public function changepassword()
    {
        return view('member.profile.changepassword');
    }
}
