<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::with('category:id,name','store')->paginate();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string|max:255',
            'category_id'=>'required|exists:categories,id',
            'status'=>'in:active,archive',
            'price'=>'nullable|numeric|min:0',        
            'compare_price'=>'nullable|numeric|gt:price',        
        ]);

        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product= Product::findOrFail($id);
        $product->load('category');
        return response([
            'data'=>$product->load('category'),
            'status'=>'201'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'sometimes|required|string|max:255',
            'description'=>'nullable|string|max:255',
            'category_id'=>'sometimes|required|exists:categories.id',
            'status'=>'in:active,archive',
            'price'=>'nullable|numeric|min:0',        
            'compare_price'=>'nullable|numeric|gt:price',        
        ]);
   

    $product->update($request->all());

    return response()->json([
        'status' => true,
        'message' => 'Product opdated successfully',
        'data'=>$product
        
    ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return response()->json([
            'message'=>'product deleted',
            
        ],200);
    }
}
