<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'name', 
        'category', 
        'location',
        'price', 
        'stock', 
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getSoldQuantityAttribute()
    {
        return $this->orderItems()->sum('quantity');
    }

}