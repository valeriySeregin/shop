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

    //public function user()
    //{
    //    return $this->belongsTo(User::class);
    //}

    public function getTotalPrice()
    {
        $completePrice = 0;
        foreach($this->products as $product) {
            $completePrice += $product->getTotalPrice();
        }

        return $completePrice;
    }

    public function saveOrder($name, $phone)
    {
        if ($this->status === 0) {
            $this->name = $name;
            $this->phone = $phone;
            $this->status = 1;
            $this->save();
            return true;
        }

        return false;
    }
}
