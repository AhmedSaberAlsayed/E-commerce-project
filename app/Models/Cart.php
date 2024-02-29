<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable= [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'product_title',
    ];



    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function Product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
