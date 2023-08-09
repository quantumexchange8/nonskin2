<?php

namespace App\Http\Controllers\Member;

use App\Models\Announcement;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\Address;
use App\Models\PaymentSetting;
use App\Models\DeliverySetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Http\Middleware\CheckCartItem;
use Illuminate\Support\Facades\Redirect;
Use Alert;

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

        return view('member.dashboard', [
            'user' => $user,
        ]);
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
        $payment_methods = PaymentSetting::whereIn('id', [1, 2])->get();
        $payment_selfpick = PaymentSetting::get();
        $delivery_methods = DeliverySetting::get();
        $default_address = Address::where('id', 1)->first();
        $shipping_address = Address::where('user_id', auth()->user()->id)->get();

        $user = User::with('cart.items', 'address.shippingCharge')
            ->where('id', Auth::id())
            ->whereHas('address', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->select('id', 'full_name', 'contact', 'email')
            ->first();

        // $shipping_methods = DeliverySetting::

        $cartItems = $user->cart ? $user->cart->items : collect();

        $subtotal = 0;
        $totalDiscount = 0; // Initialize totalDiscount variable outside the loop
        $discountedPrice = 0;
        $discount = 0;
        foreach ($cartItems as $item) {
            if ($item->product->discount == 0) {
                $subtotal += $item->product->price * $item->quantity;
            } else {
                $discountedPrice = $item->product->price - ($item->product->price * ($item->product->discount / 100));
                $discount = $item->product->price * ($item->product->discount / 100);
                $totalDiscount += $discount * $item->quantity; // Accumulate the discount for each product
                $subtotal += $discountedPrice * $item->quantity;
            }
        }

        // Calculate the total price with discount
        $totalPriceWithDiscount = $subtotal - $totalDiscount;

        // ... (existing code)

        if ($cartItems->count() > 0) {
            return view('member.checkout', [
                'cartItems' => $cartItems,
                'user' => $user,
                'payment_methods' => $payment_methods,
                'delivery_methods' => $delivery_methods,
                'subtotal' => $subtotal,
                'discountedPrice' => $discountedPrice,
                'discount' => $discount,
                'totalDiscount' => $totalDiscount,
                'totalPriceWithDiscount' => $totalPriceWithDiscount,
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
    public function internalTransferHistory() {
        return view('member.internal_transfer_history');
    }
    public function internalTransferNew() {
        return view('member.internal_transfer_new');
    }
    public function memberListing() {
        $user = Auth::user();

        $members = User::where('upline_id', $user->id)->get();

        return view('member.member_listing');
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

    public function orderHistory() {
        return view('member.order_history');
    }
    public function productList() {
        // ProductController
    }
    public function productDetail() {
        // ProductController
    }

    public function reportDownlineSales() {
        return view('member.report_downline_sales');
    }
    public function reportLeadership() {
        return view('member.report_leadership');
    }
    public function reportLevelling() {
        return view('member.report_levelling');
    }
    public function reportSales() {
        return view('member.report_sales');
    }
    public function reportWallet() {
        return view('member.report_wallet');
    }

    // public function topupHistory() {
    //     return view('member.topup_history');
    // }
    // public function topupPending() {
    //     return view('member.topup_pending');
    // }

    public function deposit() {
        return view('member.wallet_deposit');
    }
    public function withdrawal() {
        return view('member.wallet_withdrawal');
    }

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


}
