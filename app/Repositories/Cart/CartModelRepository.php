<?php
namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
// use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
class CartModelRepository implements CartRepository{
 public function get(){
    //eggerloading
     return  Cart::with('product')->get();
 } 
    public function add(Product $product,$quantity){
        $item = Cart::where('product_id','=',$product->id)
      ->first();  
      if(!$item){
         $cart=  Cart::create( [
            'user_id'=>Auth::id(),
            'product_id'=>$product->id,
            'quantity'=>$quantity
        ]);
        return $cart;
      }
    return $item->increment('quantity',$quantity);

       
    }
    public function update($id ,$quantity){
      Cart::where('id','=',$id)
      ->update([
        'quantity'=>$quantity
      ]);  
    }
    public function delete( $id){
        Cart::where('id','=',$id)
        ->delete();
    }
    public function empty(){
        Cart::quary()->delete();
    }
   public function total()
{
    return (float) Cart::join('products', 'products.id', '=', 'carts.product_id')
        ->selectRaw('SUM(products.price * carts.quantity) as total')
        ->value('total') ?? 0;
}


    // protected function getCookieId(){
    //     $cookie_id = Cookie::get('cart_id');
    //     if(!$cookie_id){
    //         $cookie_id = Str::uuid();
    //         // Cookie::queue('cart_id',$cookie_id,Carbon::now()->addDays(30));
    //         Cookie::queue('cart_id', $cookie_id, 60 * 24 * 30); // 30 يوم بالدقايق

    //     }
    //     return $cookie_id;
    // }
}