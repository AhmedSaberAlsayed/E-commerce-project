<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product_flavour;
use App\Http\Traits\Api_designtrait;
use App\Http\Filters\V1\ProductsFilter;
use App\Http\Resources\product_flavourResource;
use App\Http\Resources\product_flavourCollection;
use App\Http\Requests\Storeproduct_flavourRequest;
use App\Http\Requests\Updateproduct_flavourRequest;

class ProductFlavourController extends Controller
{
    use Api_designtrait;
    // public function __construct()
    // {
    //     $this->middleware(['auth:sanctum','Admin'])->except('index');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ProductsFilter();
        $fillterItems = $filter->transform($request); //[['column', 'operator', 'value']]
        $products = product_flavour::where($fillterItems);
        return new product_flavourCollection($products->paginate()->appends($request->query()));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeproduct_flavourRequest $request)
    {
        $store= new product_flavourResource(product_flavour::create([
            "product_id"=> $request->product_id,
            "flavor_id"=> $request->flavor_id,
            "Quantity"=> $request->Quantity,

        ]));
        return $this->api_design(200,'product_flavour add success',$store);
    }

    /**
     * Display the specified resource.
     */
    public function show(product_flavour $product_flavour)
    {
        $show=new product_flavourResource($product_flavour);
        return $this->api_design(200,'Select product_flavour ',$show);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateproduct_flavourRequest $request, product_flavour $product_flavour)
    {
        $update= $product_flavour->update([
            "product_id"=> $request->product_id,
            "flavor_id"=> $request->flavor_id
        ]);
        return $this->api_design(200,'product_flavour update success',$update,);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product_flavour $product_flavour)
    {
        $record = new product_flavourResource($product_flavour);
        $record->delete();
    return $this->api_design(200,'product_flavour delete success',$record,);
    }
}
