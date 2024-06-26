<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function billing_address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'billing_address_id');
    }

    public function shipping_address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }
}
