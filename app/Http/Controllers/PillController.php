<?php

namespace App\Http\Controllers;

use App\Http\Filters\V1\ProductsFilter;
use App\Http\Requests\StorePillRequest;
use App\Http\Requests\UpdatePillRequest;
use App\Http\Resources\PillCollection;
use App\Http\Resources\PillResource;
use App\Models\Order;
use App\Models\Pill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
       $filter = new ProductsFilter();
       $fillterItems = $filter->transform($request); //[['column', 'operator', 'value']]
       $categories = Pill::where($fillterItems);
       return new PillCollection($categories->paginate()->appends($request->query()));
   }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePillRequest $request)
    {

        $user= Auth::id();
        $TransactionID= Order::where('user_id',$user)->orderby('id','desc')->first();
        $data= Order::where('user_id',$user)
        ->Where('TransactionID',$TransactionID->TransactionID)->get();
        $pill= new Pill;
        $pill->TransactionID = $TransactionID->TransactionID;
        $pill->user_id = $TransactionID->user_id;
        foreach($data as $item){
                $pill->total_price += $item->price * $item->quantity;
            }
            $pill->save();
    }
    /**
     * Display the specified resource.
     */
    public function show(Pill $pill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePillRequest $request, Pill $pill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pill $pill)
    {
        $record = new PillResource($pill);
        $record->delete();
    return $this->api_design(200,'pill delete success',$record);
    }
}
