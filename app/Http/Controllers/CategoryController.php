<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\Api_designtrait;
use App\Http\Filters\V1\ProductsFilter;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;



class CategoryController extends Controller
{
    use Api_designtrait;

    // public function __construct()
    // {
    //     $this->middleware(['auth:sanctum','Admin'])->except('index');
    // }
    public function index( Request $request)
    {
        $categories= Category::all(['id','Category_Name']);
        return $this->api_design(200,'All Categories',$categories);


        // $filter = new ProductsFilter();
        // $fillterItems = $filter->transform($request); //[['column', 'operator', 'value']]
        // $categories = Category::where($fillterItems);
        // return new CategoryCollection($categories->paginate()->appends($request->query()));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $store= new CategoryResource(Category::create($request->all()));
        return $this->api_design(200,'Category add success',$store);

    }
    /**
     * Display the specified resource.
     */
    public function show(Category $Category)
    {

        $show=new CategoryResource($Category);
        return $this->api_design(200,'Select category ',$show);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request,$id)
    {
        $update=Category::find($id);
        $update->update($request->all());

        return $this->api_design(200,'Category update success',$update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $Category)
    {
        $record = new CategoryResource($Category);
        $record->delete();
    return $this->api_design(200,'Category delete success',$record,);
}
}
