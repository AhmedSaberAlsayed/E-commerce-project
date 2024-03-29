<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Filters\V1\ProductsFilter;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Traits\Api_designtrait;
use App\Http\Traits\ImagesTrait;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum','Admin'])->except('index');
    }
    use Api_designtrait;
    use ImagesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ProductsFilter();
        $fillterItems = $filter->transform($request); //[['column', 'operator', 'value']]
        $products = Product::where($fillterItems);
        return new ProductCollection($products->paginate()->appends($request->query()));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $fileName= time() . '.' . $request->image->extension();
        $this->uploadimg($request->image, $fileName, 'products');
        $product=product::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'categore_id'=> $request->categore_id,
            'image'=> $fileName,
        ]);
        return $this->api_design(200,'product add success',$product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
            $show=new ProductResource($product);
        return $this->api_design(200,'Select product',$show);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $fileName= time() . $request->image->extension();
    $this->uploadimg($request->image, $fileName, 'products');
    $update= $product->update([
            'name'=> $request->name,
            'description'=> $request->description,
            'categore_id'=> $request->categore_id,
            'image'=> $fileName,
        ]);
        return $this->api_design(200,'product updated success',$update);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $record = new ProductResource($product);
        unlink(public_path($record->image));
        $record->delete();
    return $this->api_design(200,'product delete success',$record);
}
// $notes= note::find( $notes_id );
// unlink(public_path($notes->images));
//  $notes->delete();
}
