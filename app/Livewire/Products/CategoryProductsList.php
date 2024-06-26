<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryProductsList extends Component
{
    use WithPagination;

    public $category_id;
    public $category_slug;

    public function mount(int $category_id, string $category_slug)
    {
        $this->category_id = $category_id;;
        $this->category_slug = $category_slug;
    }

    public function render()
    {
        $products = Product::query()
            ->whereHas('categories', function($query) {
                $query->where('categories.id', $this->category_id)
                    ->orWhere('categories.slug', $this->category_slug);
            })
            ->with('discount')
            ->paginate(20);

        return view('livewire.products.category-products-list', compact('products'));
    }
}
