<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','slug','description','price','compare_price','option','rating','feature','status'.'image','store_id'
    ];
 
    public function category(){
       return $this->belongsTo(Category::class,'category_id','id');
    }
     public function store(){
       return  $this->belongsTo(Store::class,'store_id','id');
    }

    // دي داله بستخدمها لما احتاج اعمل حاجه دايما كل مستخدم المودل اطبقها عليه
    // تضيف "نطاق عام" (global scope) لجميع الاستعلامات على هذا الموديل
    protected static function booted(){
     
        static::addGlobalScope('store',new StoreScope());
           // static::addGlobalScope('store',function(Builder $builder){
        //     $user=Auth::user();
        //     if($user->store_id){
        //                     $builder->where('store_id','=',$user->store_id);

        //     }
        // });
    }
    public function scopeActive(Builder $builder){
        $builder->where('status','=','active');
    }

    //accssesors
    public function getImageUrlAttribute(){
        if (!$this->image) {
            return "https://www.google.com/url?sa=i&url=https%3A%2F%2Fmotobros.com%2Fproduct%2Fplatinum-photo-package%2F&psig=AOvVaw2UBSyG7op_KC6aeWysKdDk&ust=1754322208760000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCLCNqLDV7o4DFQAAAAAdAAAAABAJ";
        }


        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/'. $this->image);
    }
    public function getSalePercentAttribute(){
        if(!$this->compare_price){
            return 0;
        }
        return  number_format(100 - (100* $this->price / $this->compare_price),1);
    }
}
