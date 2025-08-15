<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Cart extends Model
{
  protected $keyType = 'string';

  public $incrementing = false;
  protected $fillable = ['cookie_id', 'user_id', 'product_id', 'quantity', 'option'];
  public static function booted()
  {

    static::observe(CartObserver::class);
    // دي لوعهعملها هنا مش في اا الاobserver
    // static::creating(function(Cart $cart){
    //     $cart->id=Str::uuid();
    // });
    static::addGlobalScope('cookie_id', function (Builder $builder) {
      return $builder->where('cookie_id', '=', Cart::getCookieId());
    });
  }


  public  function user()
  {
    return  $this->belongsTo(User::class)->withDefault(['name' => 'anonymous']);
  }
  public  function product()
  {
    return $this->belongsTo(Product::class);
  }
  public static function getCookieId()
  {
    $cookie_id = Cookie::get('cart_id');
    if (!$cookie_id) {
      $cookie_id = Str::uuid();
      // Cookie::queue('cart_id',$cookie_id,Carbon::now()->addDays(30));
      Cookie::queue('cart_id', $cookie_id, 60 * 24 * 30); // 30 يوم بالدقايق

    }
    return $cookie_id;
  }
}
