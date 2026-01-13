<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $fillable =[
        'order_id','type','first_name','last_name','email','phone_number',
        'street_address','city','postal_code','state','country'
    ];
          protected $hidden =['created_at','updated_at'];
              public $timestamps = false;


}
