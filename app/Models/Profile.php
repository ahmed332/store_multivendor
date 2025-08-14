<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = 'user_id';

     protected $fillable=[
        'user_id','first_name','last_name','birthday','gender','street_address','city','state','postal_code','country'
    ];
    public function  user(){
        return $this->belongsTo(Profile::class,'user_id','id');
    }
}
