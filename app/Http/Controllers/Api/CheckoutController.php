<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Cart;
use App\Models\Order;
use Exception;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        try {
            // Assume user_id is hardcoded to 1
            $userId = 1;

            // Get cart items
            $cartItems = Cart::with('product')->where('user_id', $userId)->get();
            if ($cartItems->isEmpty()) {
                return response()->json(['error' => 'Cart is empty'], 400);
            }

            // Calculate total
            $totalAmount = 0;
            foreach ($cartItems as $item) {
                $totalAmount += $item->product->price * $item->quantity;
            }

            // Stripe Payment
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $charge = Charge::create([
                'amount' => $totalAmount * 100, // Stripe uses cents
                'currency' => 'usd',
                'source' => $request->stripeToken, // From frontend
                'description' => "Order payment for user #$userId",
            ]);

            // Save order
            Order::create([
                'user_id' => $userId,
                'total_amount' => $totalAmount,
                'payment_status' => 'paid',
            ]);

            // Clear cart
            Cart::where('user_id', $userId)->delete();

            return response()->json(['message' => 'Checkout successful!'], 200);

        } catch (Exception $e) {
            return response()->json(['error' => 'Payment failed: ' . $e->getMessage()], 500);
        }
    }
}
