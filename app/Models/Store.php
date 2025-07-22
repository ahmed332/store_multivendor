<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
        use HasFactory;
        public function products(){
                return $this->hasMany(Product::class,'store_id','id');
        }

}
