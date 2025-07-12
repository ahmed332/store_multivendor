<?php

namespace App\Models;

use App\Rules\filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    //store in database
    protected $fillable = [
        'name','parent_id','description','image','status','slug'
    ];
    public function scopeActive(Builder $builder){
        $builder->where('status','=','active');
    }
    public function scopeFilter(Builder $builder,$filters){
         if($filters['name'] ?? false ){
            $builder->where('name','LIKE',"%{$filters['name']}%");
        }
        if($filter['status'] ?? false){
            $builder->where('status','=',$filters['status']);
        }
    }
    //prevent for store in database
    // protected $gurded = ['name'];
    public static function rules($id=0){
        return[
            'name'=>"required|string|min:3|max:255|unique:categories,name,$id",
            // function($attribute,$value,$fails){
            //     if($value =='ahmedmns'){
            //         $fails('this name reserved');
            //     }
            // }
            
            // new filter(),
            'parent_id'=>[
                'int','exists:categories,id'
            ],
            'image'=>[
                'image','max:1048576','dimensions:min_width=50,min_height=50',
               
            ],
             'status'=>'required|in:active,inactive'
            ];
    }
}
