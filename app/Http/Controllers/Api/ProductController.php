<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
// use Illuminate\Http\Request as HttpRequest;
// use Illuminate\Support\Facades\Request as FacadesRequest;

class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('auth:sanctum')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //with بستخدمها مع querybuilder معرفش استخدمها مع object
        $product=  Product::filter($request->query())
        ->with('category:id,name','store:id,name')
        ->paginate();
        return ProductResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string|max:255',
            'category_id'=>'required|exists:categories,id',
            'status'=>'in:active,archive',
            'price'=>'nullable|numeric|min:0',        
            'compare_price'=>'nullable|numeric|gt:price',        
        ]);
    //      $validated = $request->validate([
    //     'name' => 'required|string|max:255',
    //     'price' => 'required|numeric',
    //     'category_id' => 'required|exists:categories,id',
    //     'store_id' => 'required|exists:stores,id',
    // ]);

    $product = Product::create($request->all());

    return response()->json([
        'status' => true,
        'message' => 'Product created successfully',
        'data' => $product,
    ], 201);
        // return Product::create($request->all);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        
        // $product= Product::with(['category:id,name','store:name'])->findOrFail($product);
        $product= $product->load('category:id,name','store:name');
        $product=new ProductResource($product);
        return response()->json([
            'success'=>'show',
            'data'=>$product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Product $product)
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
        'message' => 'Product created successfully',
        'data'=>$product
        
    ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();
        // Product::destroy($id);
        return response()->json([
            'message'=>'product deleted'
        ]);
    }
}
