<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Ranking;
use App\Models\PromotionOrdersLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Alert;
use Carbon\Carbon;

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
            $totalDiscount = 0;

            $user = Auth::user();
            $now = Carbon::now();

            $hasValidPromotion = PromotionOrdersLog::where('start_date', '<=', $now)
                ->where('end_date', '>=', $now)
                ->exists();

            $rank = Ranking::where('level', $user->rank->level)
            ->where(function ($query) use ($hasValidPromotion) {
                if ($hasValidPromotion) {
                    $query->whereIn('level', [1, 2, 3, 4, 5])
                        ->where('category', 'promotion');
                } else {
                    $query->whereIn('level', [1, 2, 3, 4, 5])
                        ->where('category', 'normal');
                }
            })
            ->first();

            // if ($user->rank_id == 2) {
            //     $memberDiscountAmount = 10;
            // } elseif ($user->rank_id == 3) {
            //     $memberDiscountAmount = 35;
            // } elseif ($user->rank_id == 4) {
            //     $memberDiscountAmount = 45;
            // } elseif ($user->rank_id == 5) {
            //     $memberDiscountAmount = 50;
            // } else {
            //     $memberDiscountAmount = 0;
            // }



            foreach ($cartItems as $item) {
                $item->product_price = $item->product->price;

                // Calculate the discount based on member's rank
                $discountedPrice = $item->product->price - ($item->product->price * ($rank->level_discount / 100));
                $discount = $item->product->price - $discountedPrice;
                $totalDiscount += $discount * $item->quantity;

                $item->discount_price = $discount;
                $item->discounted_price = $discountedPrice;
                $item->total_price = $discountedPrice * $item->quantity;
            }

            $totalPriceWithoutDiscount = $cartItems->sum(function ($item) {
                return $item->product_price * $item->quantity;
            });

            $totalPriceWithDiscount = $cartItems->sum('total_price');

            return response()->json([
                'cart' => $cart,
                'cartItems' => $cartItems,
                'total_price_without_discount' => $totalPriceWithoutDiscount,
                'total_price_with_discount' => $totalPriceWithDiscount,
                'total_discount' => $totalDiscount
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

            $user = Auth::user();
            if ($user->rank_id == 2) {
                $member_discount_amount = 10;
            } elseif ($user->rank_id == 3) {
                $member_discount_amount = 35;
            } elseif ($user->rank_id == 4) {
                $member_discount_amount = 45;
            } elseif ($user->rank_id == 5) {
                $member_discount_amount = 50;
            } else {
                $member_discount_amount = 0; // Handle other ranks if needed
            }

            // calculate product total amount before discount
            $total_price = $productPrice * $quantity;
            // calculate after discount amount
            $discount_percent_amount = $member_discount_amount * ($productPrice / 100);
            $total_discount_amount = $discount_percent_amount * $quantity;


            $subtotal = $total_price - $total_discount_amount;

            // Create a new cart item for the product with the input quantity
            $userCartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'price' => $productPrice,
                'quantity' => $quantity,
                'nett_price' => $productPrice,
                'discount_price' => $total_discount_amount,
                'total_amount' => $subtotal,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id()
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
        Alert::success('Success', 'Item added to cart successfully');
        return redirect()->back();
    }

    public function updateCart(Request $request) {
        $itemId = $request->input('itemId');
        $quantity = $request->input('quantity');

        // Update the cart item in the database using the $itemId and $quantity

        return response()->json(['message' => 'Cart updated successfully']);
    }

    public function addToCartDetails(Request $request)
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
        Alert::success('Success', 'Item added to cart successfully');
        return redirect()->back();
    }


}
