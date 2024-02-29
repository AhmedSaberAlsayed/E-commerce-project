<?php

namespace App\Http\Controllers;

use App\Http\Filters\V1\ProductsFilter;
use App\Http\Requests\StoreCODRequest;
use App\Http\Requests\UpdateCODRequest;
use App\Http\Resources\CODCollection;
use App\Http\Resources\CODResource;
use App\Models\COD;
use Illuminate\Http\Request;


class CODController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $filter = new ProductsFilter();
        $fillterItems = $filter->transform($request); //[['column', 'operator', 'value']]
        $COD = COD::where($fillterItems);
        return new CODCollection($COD->paginate()->appends($request->query()));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCODRequest $request)
    {
        $store= new CODResource(COD::create($request->all()));
        return $this->api_design(200,'COD add success',$store);

    }

    /**
     * Display the specified resource.
     */
    public function show(COD $cOD)
    {
        $show=new CODResource($cOD);
        return $this->api_design(200,'Select COD ',$show);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCODRequest $request, COD $cOD)
    {
        $update= $cOD->update($request->all());
        return $this->api_design(200,'cOD update success',$update,);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(COD $cOD)
    {
        $record = new CODResource($cOD);
        $record->delete();
    return $this->api_design(200,'cOD delete success',$record,);
    }
}
