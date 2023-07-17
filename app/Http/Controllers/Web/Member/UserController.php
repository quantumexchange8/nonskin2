<?php

namespace App\Http\Controllers\Web\Member;

use App\Models\Cart;
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
    public function checkout() {
        return view('member.checkout');
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
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $productPrice = $request->input('price');
        $quantity = $request->input('quantity');

        Cart::create([
            'user_id'       => Auth::id(),
            'product_id'    => $productId,
            'price'         => $productPrice,
            'quantity'      => $quantity,
            'updated_at'    => null,
            'created_by'    => Auth::id(),
        ]);

        return response()->json(['message' => 'Item added to cart successfully']);
    }

    public function getCartRecords() {

        $cartRecords = Cart::where('user_id', Auth::id())->latest()->take(5)->get(); // Assuming your cart records are stored in the "carts" table

        return response()->json($cartRecords);
    }


}
