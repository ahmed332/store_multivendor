<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

//لو هتعامل معاه كا pivot اعمل extends pivot
class OrderItem extends Pivot
{
    use HasFactory;
    //لو هستخدم pivot 
    // هيعتبر اسم الجدول الوسيط orderitems
    //increeminting false
    protected $table = 'order_items';
    public $incrementing = true;
    public function product(){
        return $this->belongsTo(Product::class)->withDefault([
            'name'=>$this->product_name
        ]);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
