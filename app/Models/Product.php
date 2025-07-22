<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    public function category(){
       return $this->belongsTo(Category::class,'category_id','id');
    }
     public function store(){
       return  $this->belongsTo(Store::class,'store_id','id');
    }

    // دي داله بستخدمها لما احتاج اعمل حاجه دايما كل مستخدم المودل اطبقها عليه
    // تضيف "نطاق عام" (global scope) لجميع الاستعلامات على هذا الموديل
    protected static function booted(){
        // static::addGlobalScope('store',function(Builder $builder){
        //     $user=Auth::user();
        //     if($user->store_id){
        //                     $builder->where('store_id','=',$user->store_id);

        //     }
        // });
        static::addGlobalScope('store',new StoreScope());
    }
}
