<?php

namespace App\Rules;

use Closure;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\ValidationRule;

class QuantityValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $product= Product::where([['id',request('product_id')],['Quantity','>=',$value]])->first();
        if($product)
        {
            $cart= Cart::where([['user_id',Auth::user()],['product_id',$product->id]])->first();
            if($cart)
            {
                if($cart->Quantity +$value <= $product->Quantity)
                {

                }
            }

        }

    }
}
