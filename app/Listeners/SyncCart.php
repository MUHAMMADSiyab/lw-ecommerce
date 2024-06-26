<?php

namespace App\Listeners;

use App\Models\CartItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cookie;

class SyncCart
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user_id = $event->user->id;
        $guestCartId = request()->cookie('guest_cart_id');

        info($guestCartId);

        $cartItems = CartItem::where('guest_cart_id', $guestCartId)->get();

        foreach ($cartItems as $cartItem) {
            $existingCartItem = CartItem::firstOrCreate(
                ['user_id' => $user_id, 'product_id' => $cartItem->product_id],
                ['quantity' => $cartItem->quantity]
            );

            if (!$existingCartItem->wasRecentlyCreated) {
                $existingCartItem->quantity += $cartItem->quantity;
                $existingCartItem->save();
            }

            $cartItem->delete();
        }

        Cookie::queue(Cookie::forget('guest_cart_id'));
    }
}
