<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CartItem as CartItemModel;

class CartItem extends Component
{
    public CartItemModel $cartItem;
    public int $quantity;

    public function mount()
    {
        $this->quantity = $this->cartItem->quantity;
    }

    public function updatedQuantity()
    {
        $this->updateQuantityInDB();
    }

    public function render()
    {
        return view('livewire.cart-item');
    }

    public function handleQuantityChange($type)
    {
        if ($type === 'increment') {
            $this->quantity = $this->quantity + 1;
        } else {
            if ($this->quantity > 1) {
                $this->quantity = $this->quantity - 1;
            }
        }

        $this->updateQuantityInDB();
    }

    private function updateQuantityInDB()
    {
        $this->cartItem->update(['quantity' => $this->quantity]);

        $this->dispatch('quantity-updated');
    }
}
