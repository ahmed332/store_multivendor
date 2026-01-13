<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    protected $fillable =[
        'store_id','user_id','payment_method','status','payment_status'
    ];
      protected $hidden =['created_at','updated_at'];
          public $timestamps = true;

    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name'=>'gust'
        ]);
    }

    //many to many
    public function products(){
        return $this->belongsToMany(Product::class,'order_items','order_id','product_id','id','id')
        ->using(OrderItem::class)
       
        ->withPivot('product_name','price','quantity');
    }
    public function addresses(){
        return $this->hasMany(OrderAddress::class);
    }
    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class,'order_id','id')
        ->where('type','=','billing');
    }
    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class,'order_id','id')
        ->where('type','=','shipping');
    }
    protected static function  booted()
    {
        static::creating(function(Order $order){
            $order->number = Order::getNextOrderNumber();
        });
    }
    public static function getNextOrderNumber(){
        $year = Carbon::now()->year;
        $number =Order::whereYear('created_at',$year)->max('number');
        if($number){
            return $number + 1 ;
        }
        return $year . '0001';
    }

}
