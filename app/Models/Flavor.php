<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    use HasFactory;

    protected $fillable = [
        'flavor_name',
    ];

    public function productflavorSize(){
        return $this->hasMany(product_flavour_size::class,'flavors_id');
    }



    // public function Product()
    // {
    //     return $this->hasMany(Product::class);
    // }
}
