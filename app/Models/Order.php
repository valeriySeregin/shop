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

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function calculateTotalPrice()
    {
        $totalPrice = 0;
        foreach($this->products as $product) {
            $totalPrice += $product->getTotalPrice();
        }

        return $totalPrice;
    }

    public static function eraseOrderData()
    {
        session()->forget('total_order_price');
        session()->forget('orderId');
    }

    public static function changeTotalPrice($changingPrice)
    {
        $price = self::getTotalPrice() + $changingPrice;
        session(['total_order_price' => $price]);
    }

    public static function getTotalPrice()
    {
        return session('total_order_price', 0);
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
