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
    //     'name','slug','description','price','compare_price','option','rating','feature','status'.'image','store_id'
    //
     'name',
        'price',
        'category_id',
        'store_id',
        'description', ];
    protected $hidden = [
        'created_at','updated_at','deleted_at','image'
    ];
 
    public function category(){
       return $this->belongsTo(Category::class,'category_id','id')
       ->withDefault(['name'=>'no category']);
    }
     public function store(){
       return  $this->belongsTo(Store::class,'store_id','id');
    }
     
    public function tags(){
        return $this->belongsToMany(
            Tag::class,//related model
            'product_tag',//piovit table
            'product_id',//fk for curent model
            'tag_id',//fk for the related model
            'id',//pk for current model
            'id',//ph fo related model
        );
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
        static::creating(function(Product $product){
            $product->slug=Str::slug($product->name);
        });
    }
    public function scopeActive(Builder $builder){
        $builder->where('status','=','active');
    }

    //accssesors
    //$product->image_url
    public function getImageUrlAttribute(){
        if (!$this->image) {
            return "https://www.google.com/url?sa=i&url=https%3A%2F%2Fmotobros.com%2Fproduct%2Fplatinum-photo-package%2F&psig=AOvVaw2UBSyG7op_KC6aeWysKdDk&ust=1754322208760000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCLCNqLDV7o4DFQAAAAAdAAAAABAJ";
        }


        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/'. $this->image);
    }
//auto serceh for getimageUrlAttribute
    protected $appends=['image_url','sale_percent'];
    public function getSalePercentAttribute(){
        if(!$this->compare_price){
            return 0;
        }
        return  number_format(100 - (100* $this->price / $this->compare_price),1);
    }
   public function scopeFilter(Builder $builder, $filters)
{
    $options = array_merge([
        'store_id'    => null,
        'category_id' => null,
        'tag_id'        => null,
        'status'      => 'active',
    ], $filters);

    // فلترة حسب store_id
    $builder->when($options['store_id'], function ($builder, $value) {
        $builder->where('store_id', $value);
    });

    // فلترة حسب category_id
    $builder->when($options['category_id'], function ($builder, $value) {
        $builder->where('category_id', $value);
    });

    // فلترة حسب الحالة (status)
    $builder->when($options['status'], function ($builder, $value) {
        $builder->where('status', $value);
    });
    $builder->when($options['tag_id'],function($builder,$value){
         $builder->whereExists(function($query) use ($value){
            $query->select(1)
            ->from('product_tag')
            ->whereRaw('product_id','products.id')
            ->where('tag_id',$value);
     });
    });
   
}

}
