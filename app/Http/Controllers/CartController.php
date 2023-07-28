<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getShippingCharge(Request $request)
    {
        // Get the address fields from the AJAX request
        $address_1 = $request->input('address_1');
        $address_2 = $request->input('address_2');
        $postcode = $request->input('postcode');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');

        // Find the matching address and retrieve the shipping charge
        // Adjust this logic based on your database structure and requirements
        $address = Address::where([
            'address_1' => $address_1,
            'address_2' => $address_2,
            'postcode' => $postcode,
            'city' => $city,
            'state' => $state,
            'country' => $country,
        ])->first();

        if ($address) {
            $shippingCharge = $address->shippingCharge->amount;
        } else {
            // If no matching address is found, set the shipping charge to 0 or handle it as needed
            $shippingCharge = 0;
        }

        // Return the shipping charge amount as a JSON response
        return response()->json(['shippingCharge' => $shippingCharge]);
    }


    public function getCartCount(Request $request)
    {
        // Assuming you have a one-to-many relationship between User and Cart models,
        // and you have the 'user_id' column in the carts table

        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => false, 'error' => 'User not authenticated.']);
        }

        $cartCount = CartItem::where('cart_id', auth()->user()->cart->id)
            ->count();

        return response()->json(['success' => true, 'cartCount' => $cartCount]);
    }

    public function getCartData()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $cartItems = $cart->items;
            $totalDiscount = 0; // Initialize totalDiscount variable outside the loop

            // Calculate the total price and discount for each cart item
            foreach ($cartItems as $item) {
                // Product price
                $item->product_price = $item->product->price;

                if ($item->product->discount == 0) {
                    // Discount price for each product (when no discount is applied)
                    $item->discount_price = 0;
                    $item->discounted_price = $item->product->price;
                    $item->total_price = $item->product->price * $item->quantity;
                } else {
                    // Discount price for each product (when discount is applied)
                    $discountedPrice = $item->product->price - ($item->product->price * ($item->product->discount / 100));
                    $discount = $item->product->price - $discountedPrice;
                    $totalDiscount += $discount * $item->quantity; // Accumulate the discount for each product

                    $item->discount_price = $discount;
                    $item->discounted_price = $discountedPrice;
                    $item->total_price = $discountedPrice * $item->quantity;
                }
            }

            // Calculate the total price of all items in the cart without discount
            $totalPriceWithoutDiscount = $cartItems->sum(function ($item) {
                return $item->product_price * $item->quantity;
            });

            // Calculate the total price of all items in the cart with discount
            $totalPriceWithDiscount = $cartItems->sum('total_price');

            return response()->json([
                'cart' => $cart,
                'cartItems' => $cartItems,
                'total_price_without_discount' => $totalPriceWithoutDiscount,
                'total_price_with_discount' => $totalPriceWithDiscount,
                'total_discount' => $totalDiscount // Now it will contain the sum of discounts for all products
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
        $cartItem = CartItem::with('product')
            ->where('cart_id', auth()->user()->cart->id)
            ->where('product_id', $productId)
            ->first();

        // Check if the cart item exists and if the user's cart exists
        if ($cartItem && auth()->user()->cart) {
            // Check if the cart item belongs to the authenticated user's cart
            if ($cartItem->cart_id === auth()->user()->cart->id) {
                $totalPrice = 0;
                if ($cartItem->product->discount > 0){
                    $totalPrice = $productPrice - ($productPrice*($cartItem->product->discount/100));
                }else{
                    $totalPrice = $productPrice;
                }
                $cartItem->update([
                    'quantity'  => $quantity,
                    'price'     => $totalPrice
                    // You may also update other attributes, such as 'price' if needed
                ]);

                // Retrieve the cart from the authenticated user
                $cart = auth()->user()->cart;

                // Check if the cart exists
                if ($cart) {
                    // Update the total_price in the cart model
                    $cart->total_price = 0; // Reset the total_price to recalculate it
                    $cart->total_discount = 0;
                    foreach ($cart->items as $item) {
                        if($item->product->discount == 0) {
                            $cart->total_price += $item->quantity * $item->product->price;
                        }else
                            $cart->total_price += $item->quantity * ($item->product->price - ($item->product->price*$item->product->discount/100));
                            $cart->total_discount += $item->quantity * ($item->product->price * $item->product->discount/100);
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

        $cartItem = CartItem::with('product')
            ->where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        // If the cart item already exists, increment the quantity by the input quantity
        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
            $cartItem->updated_by = Auth::id();
            $cartItem->save();
        } else {
            // Create a new cart item for the product with the input quantity
            $userCartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'price' => $productPrice,
                'quantity' => $quantity,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]);
        }

        if ($cart) {
            // Update the total_price in the cart model
            $cart->total_price = 0; // Reset the total_price to recalculate it
            $cart->total_discount = 0;
            foreach ($cart->items as $item) {
                if($item->product->discount == 0) {
                    $cart->total_price += $item->quantity * $item->product->price;
                }else
                    $cart->total_price += $item->quantity * ($item->product->price - ($item->product->price*$item->product->discount/100));
                    $cart->total_discount += $item->quantity * ($item->product->price * $item->product->discount/100);
            }
            $cart->updated_by = auth()->user()->id;
            $cart->save();
        }

        return response()->json(['message' => 'Item added to cart successfully']);
    }

    public function updateCart(Request $request) {
        $itemId = $request->input('itemId');
        $quantity = $request->input('quantity');

        // Update the cart item in the database using the $itemId and $quantity

        return response()->json(['message' => 'Cart updated successfully']);
    }



}
