<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'stock',
        'price_per_day',
        'description',
        'status'
    ];

    public function details()
    {
        return $this->hasMany(RentalDetail::class);
    }
}
