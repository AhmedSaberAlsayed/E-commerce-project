<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = [
        'Size_Number',

    ];
    public function productflavorSize(){
        return $this->hasMany(product_flavour_size::class,'sizes_id');
    }


    // public function Product()
    // {
    //     return $this->hasMany(Product::class);
    // }
}
