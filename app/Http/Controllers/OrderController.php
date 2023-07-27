<?php

namespace App\Http\Controllers;

use App\Models\Prefix;
use App\Models\Order;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Okipa\Grid\DataGrid;
use Auth;
use DB;

class OrderController extends Controller
{
    // Customer
    public function placeOrder(Request $request)
    {
        if(auth()->user()->cart->items->count() == 0){
            return redirect()->route('member.cart');
        }
        // Retrieve the form data from the request
        $id                 = $request->input('user_id');
        $totalAmount        = $request->input('total_amount');
        $receiver           = $request->input('receiver');
        $contact            = $request->input('contact');
        $email              = $request->input('email');
        $deliveryMethod     = $request->input('delivery_method');
        $paymentMethod      = $request->input('payment_method');
        $deliveryAddress    = $request->input('address');
        $deliveryFee        = $request->input('delivery_fee');

        $orderPrefix = 'NONOD'; // Prefix for Order Number
        // Find the corresponding row in the 'prefixes' table based on the prefix
        $prefixRow = Prefix::where('prefix', $orderPrefix)->first();
        // if (!$prefixRow) {
        //     // If the prefix doesn't exist, handle it as needed (e.g., show an error)
        // }
        try {
            DB::beginTransaction();
            $newOrderNumber = $prefixRow->counter + 1;
            $prefixRow->update(
                [
                    'counter' => $newOrderNumber,
                    'updated_by' => Auth::id()
                ]
            );
            // Save the form data to the Order model
            $order                      = new Order();
            $order->user_id             = $id;
            $order->order_num           = $orderPrefix . str_pad($newOrderNumber, $prefixRow->padding, '0', STR_PAD_LEFT);
            $order->total_amount        = $totalAmount;
            $order->receiver            = $receiver;
            $order->contact             = $contact;
            $order->email               = $email;
            $order->delivery_method     = $deliveryMethod;
            $order->payment_method      = $paymentMethod;
            $order->delivery_address    = $deliveryAddress;
            $order->delivery_fee        = $deliveryFee;
            $order->remarks             = 'New Order';
            $order->created_by          = Auth::id();
            $order->updated_at          = null;
            $order->save();
            $userCart = Cart::where('user_id', $id)->first();
            if ($userCart) {
                CartItem::where('cart_id', $userCart->id)->delete();
            }
            DB::commit();
            // Return a response to the AJAX request
            return response()->json(['message' => 'Order placed successfully']);
        } catch (\Exception $e) {
            DB::rollback();
            // Handle the exception as needed (e.g., log the error, return an error response)
            return response()->json(['error' => 'An error occurred while placing the order'], 500);
        }
    }

    // Admin
    public function gridData() {
        return (new DataGrid())
            ->source(Order::query())
            ->column('id', 'ID', null, 50)
            ->column('order_num', 'Order Number')
            ->column('total_amount', 'Total Amount')
            ->column('receiver', 'Receiver')
            ->column('contact', 'Contact')
            ->column('email', 'Email')
            ->column('delivery_method', 'Delivery Method')
            ->column('payment_method', 'Payment Method')
            ->column('delivery_address', 'Delivery Address')
            ->column('delivery_fee', 'Delivery Fee')
            ->column('remarks', 'Remarks')
            ->toJson();
    }

    public function new() {
        return view('admin.orders.new');
    }
    public function history() {
        return view('admin.orders.history');
    }
    public function getNewOrderData() {
        $orders = Order::all();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
