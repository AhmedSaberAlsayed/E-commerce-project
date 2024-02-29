<?php

namespace App\Http\Controllers;

use App\Http\Filters\V1\ProductsFilter;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Http\Traits\Api_designtrait;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    use Api_designtrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ProductsFilter();
        $fillterItems = $filter->transform($request); //[['column', 'operator', 'value']]
        $customers = Order::where($fillterItems);
        return new OrderCollection($customers->paginate()->appends($request->query()));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $users= Auth::id();
        $data= Cart::where('user_id',$users)->get();
        foreach($data as $item){
            $order= new Order;
                $order->user_id = $item->user_id;
                $order->product_id = $item->product_id;
                $order->quantity = $item->quantity;
                $order->price = $item->price;
                $order->payment_method = 'cash on delivery';
                $order->product_title = $item->product_title;
                $order->TransactionID = date("Y-m-d-h-m") . $item->user_id;
                $order->save();
        }
        return $this->api_design(200,'order add success', $order);
    }
    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $show=new OrderResource($order);
        return $this->api_design(200,'Select order',$show);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $update= $order->update($request->all());
        return $this->api_design(200,'order update success',$update,);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $record = new orderResource($order);
        $record->delete();
    return $this->api_design(200,'order delete success',$record,);
    }
}
