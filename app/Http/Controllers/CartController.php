<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Resources\CartResource;
use App\Http\Traits\Api_designtrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum','Admin'])->except('index');
    }

    use Api_designtrait;

    public function index()
    {
        //
    }


    public function store(StoreCartRequest $request)
    {
        $user= Auth::user();
        $store= new CartResource(Cart::create([
            'user_id'=>Auth::id(),
            'product_id'=>$request->product_id,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'product_title'=>$request->product_title,
        ]));
        return $this->api_design(200,'Cart add success',$store);
    }


    public function show(Cart $cart)
    {
        $show= new CartResource($cart);
        return $this->api_design(200,'my cart',$show);
    }

    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $update= new CartResource($cart->update([
            'user_id'=>Auth::id(),
            'product_id'=>$request->product_id,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'product_title'=>$request->product_title,
        ]));
        return $this->api_design(200,'Cart update success',$update);
    }

    public function destroy(Cart $cart)
    {
        //
    }
}
/**
 * $user = User::with('cart')->where('id','user_id')
 */
