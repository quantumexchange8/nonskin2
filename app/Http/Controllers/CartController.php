<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Auth;

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

    public function destroy(Cart $cart)
    {
        //
    }

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
}
