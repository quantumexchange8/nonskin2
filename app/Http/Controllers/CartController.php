<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
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

    public function show(Cart $cart)
    {
        //
    }

    public function edit(Cart $cart)
    {
        //
    }

    public function update(Request $request, Cart $cart)
    {
        //
    }

    public function destroy(Cart $cart, $productId)
    {
        // Make sure the cart belongs to the currently authenticated user
        if ($cart->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Error: Could not remove item from cart.');
        }

        // Find the cart item in the specified cart with the given product ID
        $cartItem = $cart->items->firstWhere('product_id', $productId);

        // Check if the cart item exists and belongs to the specified cart
        if ($cartItem) {
            // Delete the cart item from the database
            $cartItem->delete();

            return redirect()->back()->with('success', 'Item removed from cart successfully.');
        }

        return redirect()->back()->with('error', 'Error: Could not remove item from cart.');
    }



    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $productPrice = $request->input('price');
        $quantity = $request->input('quantity');

        // Retrieve the user's cart
        $cart = Cart::where('user_id', Auth::id())->first();

        // If the user doesn't have a cart, create one
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]);
        }

        // Find the cart item for the product
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        // If the cart item already exists, increment the quantity by the input quantity
        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
        } else {
            // Create a new cart item for the product with the input quantity
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'price' => $productPrice,
                'quantity' => $quantity,
                'created_by' => Auth::id(),
            ]);
        }

        return response()->json(['message' => 'Item added to cart successfully']);
    }





    public function updateCart(Request $request) {
        $itemId = $request->input('itemId');
        $quantity = $request->input('quantity');

        // Update the cart item in the database using the $itemId and $quantity

        return response()->json(['message' => 'Cart updated successfully']);
    }

    public function updateQty(Request $request) {
        $itemId = $request->input('itemId');
        $action = $request->input('action');

        $cart = Cart::find($itemId);

        if ($cart) {
            if ($action === 'minus') {
                $cart->quantity--;
            } elseif ($action === 'plus') {
                $cart->quantity++;
            }

            $cart->save();
        }

        return redirect()->route('cart');
    }

}
