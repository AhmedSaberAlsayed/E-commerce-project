<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable= [
        'user_id',
        'product_id',
        'quantity',
        'Total_Price',
    ];



    public function User():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function Product():BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function order():HasMany
    {
        return $this->hasMany(Order::class);
    }
}
