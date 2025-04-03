<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', 1)->latest()->paginate(10);
        return view('admin.cart.index', compact('carts'));
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->route('admin.cart.index')->with('success', 'Cart item removed successfully');
    }
}
