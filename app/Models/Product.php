<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = [];

    protected $casts = [
        'images' => 'array'
    ];

    protected $appends = [
        'thumbnail',
        'calculated_price'
    ];

     /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function thumbnail(): Attribute
    {
        return Attribute::make(get: function () {
            return count($this->images)
                ? $this->images[0]
                : collect($this
                    ->variations
                    ->filter(fn ($variation) => count($variation->images))
                    ->first()
                    ?->images)
                    ?->shuffle()[0];
        });
    }

    public function calculatedPrice(): Attribute
    {
        return Attribute::make(function () {
            if (is_null($this->discount)) {
                return $this->price;
            }

            $discount_amount = 0;
            if ($this->discount->type === 'percentage') {
                $discount_amount = ($this->price * $this->discount->value) / 100;
            } elseif ($this->discount->type === 'amount') {
                $discount_amount = $this->discount->value;
            }

            return $this->price - $discount_amount;
        });
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function variations(): HasMany
    {
        return $this->hasMany(Variation::class);
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    protected static function booted()
    {
        if (!app()->runningInConsole() && auth()->check()) {
            static::creating(function ($model) {
                $model->user_id = auth()->id();
            });
        }
    }
}
