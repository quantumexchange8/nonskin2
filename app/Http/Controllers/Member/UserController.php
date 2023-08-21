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
use App\Models\PaymentSetting;
use App\Models\DeliverySetting;
use App\Models\CompanyInfo;
use App\Models\Ranking;
use App\Http\Middleware\CheckCartItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
Use Alert;
use Session;

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
        $next_rank = Ranking::where('id', $user->rank_id+1)->pluck('name')->first();
        $referral = User::where('upline_id', Auth::id())->count();

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

        $subtotal = 0;

        return view('member.cart', compact('cartItems', 'subtotal', 'cart'));
    }

    public function checkout()
    {
        $payment_methods = PaymentSetting::whereIn('id', [1, 2, 3])->get();
        $payment_selfpick = PaymentSetting::get();
        $delivery_methods = DeliverySetting::get();
        $default_address = Address::where('id', 1)->first();
        $shipping_address = Address::where('user_id', auth()->user()->id)->get();

        $user = User::with('cart.items', 'address.shippingCharge')
            ->where('id', Auth::id())
            ->whereHas('address', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->first();

        // $shipping_methods = DeliverySetting::

        $cartItems = $user->cart ? $user->cart->items : collect();



        $subtotal = 0;
        $totalDiscount = 0; // Initialize totalDiscount variable outside the loop
        $discountedPrice = 0;
        $discount = 0;
        $product_price = 0;
        $discount_percent_amount = 0;
        foreach ($cartItems as $item) {
            if ($item->product->discount == 0) {
                $product_price = $item->product->price;

                if($user->rank_id == 2) {
                    $member_discount_amount = 10;

                    $discount_percent_amount = $member_discount_amount * ($product_price/100); // 10% amount of product price

                    $discounted_product_price = $product_price - $discount_percent_amount; //product price - 10%

                    $subtotal += $discounted_product_price * $item->quantity;
                }

            } else {
                $discountedPrice = $item->product->price - ($item->product->price * ($item->product->discount / 100));
                $discount = $item->product->price * ($item->product->discount / 100);
                $totalDiscount += $discount * $item->quantity; // Accumulate the discount for each product
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
                // 'totalPriceWithDiscount' => $totalPriceWithDiscount,
                'default_address' => $default_address,
                'payment_selfpick' => $payment_selfpick,
                'shipping_address' => $shipping_address,
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
        return view('member.cash_wallet');
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
    public function memberNetworkTree() {
        return view('member.member_network_tree');
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

    public function ShippingAddress()
    {
        return view('member.profile.shippingaddress');
    }

    public function changepassword()
    {
        return view('member.profile.changepassword');
    }
}
