<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // protected $cart;
    // public function __construct(CartModelRepository $cart){
    //     $this->cart = $cart;
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(CartModelRepository  $cart)
    {
        dd($cart->get());
        return view('Front.cart',[
            'cart'=>$cart
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,CartRepository $cart)
    {
        $request->validate([
            'product_id'=>['required','int,exist:product,id'],
            'quantity'=>['nullable','int','min:1'],
        ]);
        $product = Product::findOrFail($request->post('product_id'));
        $cart->add($product,$request->quantity);
        return redirect()->back()->with('success','product addedd to cart');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, CartRepository $cart)
    {
         $request->validate([
            'product_id'=>['required','int,exist:product,id'],
            'quantity'=>['nullable','int','min:1'],
        ]);
        $product = Product::findOrFail($request->post('product_id'));
        $cart->update($product,$request->quantity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRepository $cart, $id)
    {
        
        $cart->delete($id);
    }
}
