<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Size;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;



    protected $fillable = [
        'Product_Name',
        'description',
        'image' ,
        'category_id',
        'price',
        'size',
        'quantity',
    ];
    public function Category(){
        return $this->belongsTo(category::class);
    }
    public function Flavors():BelongsToMany
    {
        return $this->belongsToMany(Flavor::class);
    }

    public function Cart()
    {
        return $this->hasMany(Cart::class,'product_id');
    }
    public function Favorite()
    {
        return $this->hasMany(Favorite::class);
    }


    public function getImageAttribute($value){
        return 'images/products/' .$value ;
    }
}
