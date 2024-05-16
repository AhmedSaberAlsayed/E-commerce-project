<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable= [
        'cart_id',
        'order_date',
        'payment_method',
        'payment_status',
        'c_o_d_s_id'
    ];


    public function cart():BelongsTo
    {
        return $this->belongsTo(Cart::class,'cart_id');
    }
    public function COD():BelongsTo
    {
        return $this->belongsTo(COD::class,'c_o_d_s_id');
    }
}
