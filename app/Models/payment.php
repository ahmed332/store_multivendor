<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
     protected $fillable = [
        'order_id',
        'amount',
        'currancy',
        'method',
        'status',
        'transaction_id',
        'transaction_data',
    ];
}
