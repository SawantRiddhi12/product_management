<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    /**
     * Display the cart items (GET /api/cart)
     */
    public function index()
    {
        $userId = 1; // Hardcoded user ID
        $cartItems = Cart::where('user_id', $userId)->with('product.images')->get();
        $totalAmount = $cartItems->sum(fn ($item) => $item->product->price * $item->quantity);

        return response()->json([
            'success' => true,
            'data' => CartResource::collection($cartItems),
            'cart_total' => $totalAmount,
        ]);
    }

    /**
     * Add a product to the cart (POST /api/cart)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = 1; // Hardcoded user ID

        // Check if product is already in the cart
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $validated['quantity']);
        } else {
            $cartItem = Cart::create([
                'user_id' => $userId,
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ]);
        }

        return new CartResource($cartItem);
    }

    /**
     * Update the quantity of a cart item (PUT /api/cart/{id})
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::find($id);

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
        }

        $cartItem->update(['quantity' => $validated['quantity']]);

        return new CartResource($cartItem);
    }

    /**
     * Remove an item from the cart (DELETE /api/cart/{id})
     */
    public function destroy($id)
    {
        $cartItem = Cart::find($id);

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
        }

        $cartItem->delete();

        return response()->json(['success' => true, 'message' => 'Cart item removed']);
    }
}

