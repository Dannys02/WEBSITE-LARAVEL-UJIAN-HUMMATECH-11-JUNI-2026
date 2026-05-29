<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalDetail extends Model
{
    protected $fillable = [
        'rental_id',
        'product_id',
        'qty',
        'price',
        'subtotal',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function rentals()
    {
        return $this->belongsTo(Rental::class);
    }
}
