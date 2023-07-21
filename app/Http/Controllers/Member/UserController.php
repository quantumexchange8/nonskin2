<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class UserController extends Controller
{
    public function announcement() {
        return view('member.announcement');
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
    public function checkout() {
        $user = User::with('cart')->where('id', Auth::id())
        ->select('id', 'name', 'contact', 'email', 'address_1', 'address_2', 'city', 'postcode', 'state', 'country', 'delivery_address_1', 'delivery_address_2', 'delivery_city', 'delivery_postcode', 'delivery_state', 'delivery_country')
        ->first();

        $cartItems = CartItem::with('cart', 'product')
        ->whereHas('cart', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->latest()
        ->get();
        return view('member.checkout', compact('cartItems', 'user'));
    }
    public function commission() {
        return view('member.commission');
    }
    public function internalTransferHistory() {
        return view('member.internal_transfer_history');
    }
    public function internalTransferNew() {
        return view('member.internal_transfer_history');
    }
    public function memberNetwork() {
        return view('member.member_network');
    }
    public function memberTree() {
        return view('member.member_tree');
    }
    public function orderHistory() {
        return view('member.order_history');
    }
    public function orderPending() {
        return view('member.order_pending');
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
    public function topupHistory() {
        return view('member.topup_history');
    }
    public function topupPending() {
        return view('member.topup_pending');
    }
    public function withdrawalHistory() {
        return view('member.withdrawal_history');
    }
    public function withdrawalPending() {
        return view('member.withdrawal_pending');
    }

    // AJAX


    public function getCartRecords() {

        $cartRecords = Cart::where('user_id', Auth::id())->latest()->take(5)->get(); // Assuming your cart records are stored in the "carts" table

        return response()->json($cartRecords);
    }


}
