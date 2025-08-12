<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{
     public $incrementing=false;
    protected $fillable=['cookie_id','user_id','product_id','quantity','option'];
    public static function booted(){

        static::observe(CartObserver::class);
        //دي لوعهعملها هنا مش في اا الاobserver
        // static::creating(function(Cart $cart){
        //     $cart->id=Str::uuid();
        // });
    }
    public  function user(){
        $this->belongsTo(User::class)->withDefault(['name'=>'anonymous']);
    }
     public  function product(){
        $this->belongsTo(Product::class);
    }
}
