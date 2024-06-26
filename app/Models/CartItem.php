<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CartItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variations(): BelongsToMany
    {
        return $this->belongsToMany(Variation::class, 'cart_item_variation');
    }

    public function getVariationImage()
    {
        if (count($this->product->images)) {
            return $this->product->images[0];
        }

        return $this->variations
            ->filter(
                fn ($variation) => count($variation['images'])
            )
            ->first()
            ?->images[0];
    }
}
