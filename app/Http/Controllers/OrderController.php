<?php

namespace App\Http\Controllers;

use App\Models\Prefix;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\WalletHistory;
use Illuminate\Http\Request;
use Okipa\Grid\DataGrid;
use Auth;
use DB;

class OrderController extends Controller
{
    // Customer
    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        // dd($request->all());
        if(auth()->user()->cart->items->count() == 0){
            return redirect()->route('member.cart');
        }
        // Retrieve the form data from the request
        $id                 = $request->input('user_id');
        $totalAmount        = $request->input('total_amount');
        $receiver           = $request->input('receiver');
        $contact            = $request->input('contact');
        $email              = $request->input('email');
        $price              = $request->input('price');
        $deliveryMethod     = $request->input('delivery_method');
        $paymentMethod      = $request->input('payment_method');
        $discountAmt        = $request->input('discount_amt');
        $deliveryAddress    = $request->input('address');
        $deliveryFee        = $request->input('delivery_fee');
        $ProductWallet      = $request->input('product_wallet');

        $orderPrefix = 'NONOD'; // Prefix for Order Number
        $transactionPrefix = 'NONT';
        // Find the corresponding row in the 'prefixes' table based on the prefix
        $prefixRow = Prefix::where('prefix', $orderPrefix)->first();
        $prefixRow2 = Prefix::where('prefix', $transactionPrefix)->first();
        // if (!$prefixRow) {
        //     // If the prefix doesn't exist, handle it as needed (e.g., show an error)
        // }

        if($request->hasFile('payment_proof') != null) {
            $request->validate([
                'payment_proof' => 'nullable|image|max:2048', // Adjust the allowed mime types and file size as needed
            ]);
        }


        try {
            $imageName1 = null; // Initialize the variable

            if ($request->hasFile('payment_proof')){
                $imageName1 = time().'.'.$request->payment_proof->extension();
                $request->payment_proof->move(public_path('images/payment-proof'), $imageName1);
            }

            $nettprice = $price - $discountAmt + $deliveryFee;


            if($paymentMethod == 'Purchase Wallet'){

                //  Calculate purchase Wallet Deduct product amount
                $balance = $user->purchase_wallet;

                if($balance >= $totalAmount) {
                    $balance_remain = $balance - $totalAmount;

                    $user->product_wallet -= $ProductWallet;
                    $user->purchase_wallet = $balance_remain;
                    $user->save();

                    if ($user) {
                        // Update the user's personal_sales with the order's total_amount
                        $user->personal_sales += $price;
                        $user->group_sales += $price;
                        $user->save();
                    }
                }
            } else {
                $user->product_wallet -= $ProductWallet;
                $user->save();
            }

            DB::beginTransaction();
            $newOrderNumber = $prefixRow->counter + 1;
            $prefixRow->update(
                [
                    'counter' => $newOrderNumber,
                    'updated_by' => Auth::id()
                ]
            );
            if($paymentMethod == 'Manual Transfer') {
                // Save the form data to the Order model
                $order                      = new Order();
                $order->user_id             = $id;
                $order->order_num           = $orderPrefix . str_pad($newOrderNumber, $prefixRow->padding, '0', STR_PAD_LEFT);
                $order->total_amount        = $totalAmount;
                $order->nett_price          = $nettprice;
                $order->receiver            = $receiver;
                $order->contact             = $contact;
                $order->email               = $email;
                $order->price               = $price;
                $order->discount_amt        = $discountAmt;
                $order->delivery_method     = $deliveryMethod;
                $order->product_wallet      = $ProductWallet;
                $order->payment_method      = $paymentMethod;
                $order->delivery_address    = $deliveryAddress;
                $order->delivery_fee        = $deliveryMethod == 'Delivery' ? $deliveryFee : 0;
                $order->status              = 1;//processing
                $order->remarks             = null;
                $order->created_by          = Auth::id();
                if ($imageName1 !== null) {
                    $order->payment_proof = $imageName1;
                    $order->status = 1; // Processing
                } else {
                    $order->payment_proof = null;
                    $order->status = 9; // Pending payment
                }
                $order->save();
            } else {
                $order                      = new Order();
                $order->user_id             = $id;
                $order->order_num           = $orderPrefix . str_pad($newOrderNumber, $prefixRow->padding, '0', STR_PAD_LEFT);
                $order->total_amount        = $totalAmount;
                $order->nett_price          = $nettprice;
                $order->receiver            = $receiver;
                $order->contact             = $contact;
                $order->email               = $email;
                $order->price               = $price;
                $order->discount_amt        = $discountAmt;
                $order->product_wallet      = $ProductWallet;
                $order->delivery_method     = $deliveryMethod;
                $order->payment_method      = $paymentMethod;
                $order->delivery_address    = $deliveryAddress;
                $order->delivery_fee        = $deliveryMethod == 'Delivery' ? $deliveryFee : 0;
                $order->status              = 1;//processing
                $order->remarks             = null;
                $order->created_by          = Auth::id();

                $order->save();
            }


            if($paymentMethod == 'Online Banking') {
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
                $payment->gateway       = null;
                $payment->status        = 'Pending';
                $payment->remarks       = null;
                $payment->receipt       = null;
                $payment->created_by    = Auth::id();
                $payment->save();

                $order->update([
                    'payment_id' => $payment->id,
                    'created_at' => $order->created_at,
                    'updated_by' => Auth::id()
                ]);
            }


            $wallet = new WalletHistory();
            $wallet->user_id =  Auth::id();
            $wallet->wallet_type = 'Purchase Wallet';
            $wallet->type = 'Purchase';
            $wallet->cash_in = null;
            $wallet->cash_out = $totalAmount;
            $wallet->balance = Auth::user()->purchase_wallet;
            $wallet->save();

            if($ProductWallet > 0 ) {
                $wallet = new WalletHistory();
                $wallet->user_id =  Auth::id();
                $wallet->wallet_type = 'Product Wallet';
                $wallet->type = 'Purchase';
                $wallet->cash_in = null;
                $wallet->cash_out = $ProductWallet;
                $wallet->balance = Auth::user()->product_wallet;
                $wallet->save();
            }

            foreach(auth()->user()->cart->items as $item) {
                $orderItem                  = new OrderItem();
                $orderItem->order_num       = $order->order_num;
                $orderItem->product_id      = $item->product_id;
                $orderItem->price           = $item->price;             // because price in cart is the discounted/selling/price that user needs to pay per qty
                $orderItem->discount        = $item->product->discount; // gets discount information for reference
                $orderItem->quantity        = $item->quantity;
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
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getUserPurchaseWalletBalance(){

        $user = Auth::user();
        $purchaseWalletBalance = $user->purchase_wallet;

        return response()->json(['purchase_wallet_balance' => $purchaseWalletBalance]);

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
    // public function history() {
    //     return view('admin.orders.history');
    // }

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
