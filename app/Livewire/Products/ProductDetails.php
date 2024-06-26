<?php

namespace App\Livewire\Products;

use App\Livewire\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use \Illuminate\Support\Str;

class ProductDetails extends Component
{
    public int $id;
    public string $slug;
    public array $images;
    public Collection|array|\App\Models\Variation $current_variations;
    public Product $product;
    public bool $outOfStock = false;
    public bool $productAlreadyInCart = false;

    public function mount(int $id, string $slug)
    {
        $this->id = $id;
        $this->slug = $slug;

        $this->product = Product::query()
            ->with(['variations', 'discount'])
            ->where('id', $this->id)
            ->orWhere('slug', $this->slug)
            ->firstOrFail();


        $has_variation_images = $this->product->variations->count() &&
            $this->product->variations->contains(fn ($variation) => count($variation['images']));
        $variation_images = $this->product->variations
            ->filter(
                fn ($variation) => count($variation['images'])
            )
            ->first()
            ?->images;

        if (count($this->product->images)) {
            $this->images = $this->product->images;
        } elseif ($has_variation_images) {
            $variations = $this->product
                ->variations
                ->groupBy('attribute_name')
                ->map(fn ($variation) => $variation->first()->toArray())->values()->all();
            $this->current_variations = $variations;
            $this->images = $variation_images;
        }

        if ($this->checkProductInCart()) {
            $this->productAlreadyInCart = true;
        }
    }

    public function render()
    {
        return view('livewire.products.product-details');
    }

    public function handleAddToCart(Product $product, $variations)
    {
        $guestCartId = request()->cookie('guest_cart_id');

        if (!$guestCartId) {
            $guestCartId = (string) Str::uuid();
            Cookie::queue('guest_cart_id', $guestCartId, 60 * 24 * 30);
        }

        $userId = auth()->check() ? auth()->id() : null;

        $cartItem = CartItem::firstOrNew(
            [
                'user_id' => $userId,
                'guest_cart_id' => $userId ? null : $guestCartId,
                'product_id' => $product->id,
            ]
        );

        $cartItem->quantity = 1;
        $cartItem->save();

        $variationsIds = collect($variations)->pluck('id');
        $cartItem->variations()->sync($variationsIds);
    }

    #[On('stock-out')]
    public function makeOutOfStock()
    {
        $this->outOfStock = true;
    }

    private function checkProductInCart()
    {
        $userId = auth()->id();
        $guestCartId = request()->cookie('guest_cart_id');

        $productInCart = CartItem::query()
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when(!$userId && $guestCartId, function ($query) use ($guestCartId) {
                return $query->where('guest_cart_id', $guestCartId);
            })
            ->where('product_id', $this->id)
            ->exists();

        return $productInCart;
    }
}
