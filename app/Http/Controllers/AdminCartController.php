<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class AdminCartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('cartItems')->get();
        return response()->json($carts, 200);
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->cartItems()->delete();
        $cart->delete();

        return response()->json(['message' => 'Cart deleted successfully'], 200);
    }
}
