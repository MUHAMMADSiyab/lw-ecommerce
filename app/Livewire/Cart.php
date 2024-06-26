<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class Cart extends Component
{
    protected $listeners = [
        'add-to-cart' => 'handleAddToCart',
        'quantity-updated' => '$refresh',
    ];

    public Product $product;
    public int $quantity = 1;
    public float $subtotal;

    public function render()
    {
        $userId = auth()->id();
        $guestCartId = request()->cookie('guest_cart_id');

        $cartItems = CartItem::query()
            ->with('product', 'variations')
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when(!$userId && $guestCartId, function ($query) use ($guestCartId) {
                return $query->where('guest_cart_id', $guestCartId);
            })
            ->latest()
            ->get();

        $this->subtotal = $cartItems
            ->sum(fn ($cartItem) => $cartItem->product->price * $cartItem->quantity);

        return view('livewire.cart', compact('cartItems'));
    }

    #[On(['cart-item-deleted'])]
    public function removeFromCart(CartItem $cartItem)
    {
        $cartItem->delete();
    }
}
