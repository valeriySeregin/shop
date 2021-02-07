<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function getTotalPrice()
    {
        $completePrice = 0;
        foreach($this->products as $product) {
            $completePrice += $product->getTotalPrice();
        }

        return $completePrice;
    }
}
