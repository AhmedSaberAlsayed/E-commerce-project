<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Traits\ImagesTrait;
use App\Http\Traits\Api_designtrait;
use App\Http\Filters\V1\ProductsFilter;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     // $this->middleware(['auth:sanctum','Admin'])->except('index');
    // }
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
            'Product_Name'=> $request->Product_Name,
            'description'=> $request->description,
            'price'=> $request->price,
            'size'=> $request->size,
            'quantity'=> $request->quantity,
            'category_id'=> $request->category_id,
            'image'=> $fileName,
            'flavors'=> $request->flavors
        ]);
        $product->Flavors()->attach($request->flavors);
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
    public function update(UpdateProductRequest $request, product $product )
    {
        $fileName= time() . $request->image->extension();
        $this->uploadimg( $request->image , $fileName , 'products', $product->image );
    $update= $product->update([
            'Product_Name'=> $request->Product_Name,
            'description'=> $request->description,
            'price'=> $request->price,
            'size'=> $request->size,
            'quantity'=> $request->quantity,
            'category_id'=> $request->category_id,
            'image'=> $fileName,
        ]);
        $product->Flavors()->attach($request->flavors);
        return $this->api_design(200,'Product update success',$update,);
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
