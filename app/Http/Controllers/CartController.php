<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getCartData()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $cartItems = $cart->items;

            // Calculate the total price for each cart item
            foreach ($cartItems as $item) {
                $item->total_price = $item->product->price * $item->quantity;
            }

            // Calculate the total price of all items in the cart
            $totalPrice = $cartItems->sum('total_price');

            return response()->json([
                'cart' => $cart,
                'cartItems' => $cartItems,
                'total_price' => $totalPrice,
            ]);
        }

        return response()->json(['message' => 'Cart not found'], 404);
    }




    public function update(Request $request, Cart $cart)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $productPrice = $request->input('price');

        // Find the cart item associated with the provided productId and the user's cart
        $cartItem = CartItem::where('cart_id', auth()->user()->cart->id)
            ->where('product_id', $productId)
            ->first();

        // Check if the cart item exists and if the user's cart exists
        if ($cartItem && auth()->user()->cart) {
            // Check if the cart item belongs to the authenticated user's cart
            if ($cartItem->cart_id === auth()->user()->cart->id) {
                $cartItem->update([
                    'quantity' => $quantity,
                    // You may also update other attributes, such as 'price' if needed
                ]);

                // Calculate subtotal (price * quantity) and update total_price in Cart model
                $subtotal = $productPrice * $quantity;

                // Retrieve the cart from the authenticated user
                $cart = auth()->user()->cart;

                // Check if the cart exists
                if ($cart) {
                    // Update the total_price in the cart model
                    $cart->total_price = 0; // Reset the total_price to recalculate it
                    foreach ($cart->items as $item) {
                        $cart->total_price += $item->quantity * $item->product->price;
                    }
                    $cart->save();

                    return response()->json(['message' => 'Cart item updated successfully']);
                }
            }
        }

        return response()->json(['message' => 'Error updating cart item'], 400);
    }





    public function destroy(Cart $cart, $productId)
    {
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem && $cartItem->cart_id === $cart->id && $cart->user_id === Auth::id()) {
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

        // If the user doesn't have a cart
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]);
        }

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
