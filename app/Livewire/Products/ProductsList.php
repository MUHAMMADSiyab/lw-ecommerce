<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsList extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::query()
            ->with('discount')
            ->paginate(20);

        return view('livewire.products.products-list', compact('products'));
    }
}
