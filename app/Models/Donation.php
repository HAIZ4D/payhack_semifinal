<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'product_id',
        'accepted',
        'amount',
        'total_with_donation',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
