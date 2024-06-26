<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\Product as ProductModel;

class Product extends Component
{
    public ProductModel $product;

    public function render()
    {
        return view('livewire.products.product');
    }
}
