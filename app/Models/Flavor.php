<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flavor extends Model
{
    use HasFactory;

    protected $fillable = [
        'flavor_name',
    ];





    public function Products():HasMany
    {
        return $this->hasMany(Product::class);
    }
}
