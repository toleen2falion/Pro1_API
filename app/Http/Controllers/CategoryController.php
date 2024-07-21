<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\CRUD_Trait;

use App\Http\Requests\{
    createCategoryRequest,
    updateCategoryRequest,
  
};
use App\Http\Resources\CategoryResource;
/////
use Illuminate\Support\Carbon;
// use Carbon\Carbon;
/////

class CategoryController extends Controller
{
    use CRUD_Trait;

    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ظظ
    return  Carbon::now()."__". Carbon::now()->subDays(3);
        // ظظظظظ
        $this->authorize('viewAny',Category::class);
       $c=Category::whereNull('superCategory_id')->with('children','products')->get();

       return CategoryResource::collection($c);
        
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(createCategoryRequest $request)
    {
        // 
        // $this->authorize('create',Category::class);
        
        return  $this->createCategory(Category::class,$request );
        
          
    }

   

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $this->authorize('view',$category);
       return CategoryResource::collection(Category::where('id',$category->id)->with('children','products')->get());
    
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category,updateCategoryRequest $request)
    {
        // $this->authorize('update',$category);
        return $this->updateData($category,$request);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete',$category);
        // return $category;
        $category->delete();
        return $this->successMessage('Deleted successfully',200);
    }
}
