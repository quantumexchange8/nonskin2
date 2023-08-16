<?php

namespace App\Http\Controllers;

use App\Models\Prefix;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
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
        // dd($request);
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
        $transactionPrefix = 'NONT';
        // Find the corresponding row in the 'prefixes' table based on the prefix
        $prefixRow = Prefix::where('prefix', $orderPrefix)->first();
        $prefixRow2 = Prefix::where('prefix', $transactionPrefix)->first();
        // if (!$prefixRow) {
        //     // If the prefix doesn't exist, handle it as needed (e.g., show an error)
        // }

        $request->validate([
            'payment_proof' => 'nullable|image|max:2048|mimes:jpeg,jpg,png,pdf', // Adjust the allowed mime types and file size as needed
        ]);

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
            $order->delivery_fee        = $deliveryMethod == 'Delivery' ? $deliveryFee : 0;
            $order->status              = 1;//processing
            $order->remarks             = null;
            $order->created_by          = Auth::id();
            $order->updated_at          = null;
            
            
            if ($request->payment_proof != null) {
                // dd($request->payment_proof);
                $order->payment_proof = null;
                
            } else {
                // No image uploaded, set payment_proof to null
                $order->payment_proof = null;
            }

            $order->save();


            $newTransactionNumber = $prefixRow2->counter + 1;
            $prefixRow2->update(
                [
                    'counter' => $newTransactionNumber,
                    'updated_by' => Auth::id()
                ]
            );
            $payment                = new Payment();
            $payment->payment_num   = $transactionPrefix . str_pad($newTransactionNumber, $prefixRow2->padding, '0', STR_PAD_LEFT);
            $payment->type          = 'Deposit';
            $payment->user_id       = Auth::id();
            $payment->amount        = $totalAmount;
            $payment->gateway       = 'none';
            $payment->status        = 'Pending';
            $payment->remarks       = null;
            $payment->receipt       = null;
            $payment->updated_at    = null;
            $payment->created_by    = Auth::id();
            $payment->save();

            $order->update([
                'payment_id' => $payment->id,
                'created_at' => $order->created_at,
                'updated_by' => Auth::id()
            ]);

            foreach(auth()->user()->cart->items as $item) {
                $orderItem                  = new OrderItem();
                $orderItem->order_num       = $order->order_num;
                $orderItem->product_id      = $item->product_id;
                $orderItem->price           = $item->price;             // because price in cart is the discounted/selling/price that user needs to pay per qty
                $orderItem->discount        = $item->product->discount; // gets discount information for reference
                $orderItem->quantity        = $item->quantity;
                $orderItem->updated_at      = null;
                $orderItem->created_by      = Auth::id();
                $orderItem->save();
            }

            $userCart = Cart::where('user_id', $id)->first();
            if ($userCart) {
                CartItem::where('cart_id', $userCart->id)->delete();

                $userCart->update(
                    [
                        'total_price' => 0,
                        'total_discount' => 0
                    ]
                );
            }
            DB::commit();
            // Return a response to the AJAX request
            return response()->json(['message' => 'Order placed successfully']);
        } catch (\Throwable $e) {
            DB::rollback();
            // Handle the exception as needed (e.g., log the error, return an error response)
            return response()->json(['error' => 'An error occurred while placing the order'], 500);
        }
    }

    // Admin
    public function new() {
        // $orders = Order::where('status', 'New')->get();
        // $ordersJson = json_encode($orders);
        // dd($orders);

        $orders = Order::get();

        return view('admin.orders.orderlisting', [
            'orders' => $orders,
        ]);
    }
    public function history() {
        return view('admin.orders.history');
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
