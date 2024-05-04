<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use HasFactory;

    protected $fillable= ['Category_Name'];
    protected $table= 'categores';

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
