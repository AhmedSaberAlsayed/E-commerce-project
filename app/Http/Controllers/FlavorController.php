<?php

namespace App\Http\Controllers;

use App\Models\flavor;
use Illuminate\Http\Request;
use App\Http\Traits\Api_designtrait;
use App\Http\Resources\FlavorResource;
use App\Http\Filters\V1\ProductsFilter;
use App\Http\Resources\FlavorCollection;
use App\Http\Requests\StoreflavorRequest;
use App\Http\Requests\UpdateflavorRequest;

class flavorController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth:sanctum','Admin'])->except('index');
    // }
    use Api_designtrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ProductsFilter();
        $fillterItems = $filter->transform($request); //[['column', 'operator', 'value']]
        $customers = flavor::where($fillterItems);
        return new FlavorCollection($customers->paginate()->appends($request->query()));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreflavorRequest $request)
    {
        $store= new FlavorResource(flavor::create([
            "flavor_name"=>$request->flavor_name,
        ]));
        return $this->api_design(200,'flavor add success',$store);
    }

    /**
     * Display the specified resource.
     */
    public function show(flavor $flavor)
    {
        $show=new flavorResource($flavor);
        return $this->api_design(200,'Select flavor ',$show);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateflavorRequest $request, flavor $flavor)
    {
        $update= $flavor->update([
            "flavorName"=>$request->flavorName,
        ]);
        return $this->api_design(200,'flavor update success',$update,);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(flavor $flavor,)
    {
        $record = new flavorResource($flavor);
        $record->delete();
    return $this->api_design(200,'flavor delete success',$record,);
    }
}
