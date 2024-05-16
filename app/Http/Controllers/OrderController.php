<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Traits\Api_designtrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;
use App\Http\Filters\V1\ProductsFilter;
use App\Http\Resources\OrderCollection;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;


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
        $data= Cart::where('user_id',Auth::id())->get();
        foreach($data as $item){
            $order= new Order;
                $order->cart_id = $item->id;
                $order->order_date =date("Y-m-d-h-m") ;
                $order->c_o_d_s_id= $request->c_o_d_s_id;
                $order->save();
                // $order->product_id = $item->product_id;
                // $order->Total_Price = $item->Total_Price;
                // $order->TransactionID = date("Y-m-d-h-m") . $item->user_id;
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
        return $this->api_design(200,'order update success',$update);
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
