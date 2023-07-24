<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCartItem
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        // Check if the user has cart items
        if ($user && $user->cartItems->count() > 0) {
            return $next($request);
        }

        // Redirect the user to another route if they don't have cart items
        return redirect()->route('cart')->with('message', 'You need to have items in your cart to proceed to checkout.');
    }

}
