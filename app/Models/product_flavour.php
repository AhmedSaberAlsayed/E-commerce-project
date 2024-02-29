<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_flavour extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'flavor_id',
    ];
    protected $table= 'product_flavours';

    public function product(){
        return $this->belongsTo(product::class,"product_id");
    }

    public function Flavor(){
        return $this->belongsTo(Flavor::class,"flavor_id");
    }
}
