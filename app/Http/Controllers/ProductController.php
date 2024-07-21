<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\CRUD_Trait;

use App\Http\Requests\{
    createProductRequest,
    updateProductRequest,
  
};
use App\Http\Resources\ProdactResource;

class ProductController extends Controller
{
    use CRUD_Trait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',Product::class);
        return ProdactResource::collection(Product::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(createProductRequest $request)
    {
        //
        return  $this->createProduct(Product::class,$request);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $this->authorize('view',$product);
        
        return  new ProdactResource(Product::findOrFail($product->id));

    }

 
    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, updateProductRequest $request)
    {
       
        return $this->updateData($product,$request);
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete',$product);
        $product->delete();
        return $this->successMessage('Deleted successfully',200);
       
    }
}
