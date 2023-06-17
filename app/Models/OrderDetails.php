<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    public $timestamps =false;
    protected $fillable = [
       'order_id', 'order_code', 'product_id', 'product_name', 'sell_price', 'sell_quantity'
    ];
    protected $table = 'order_details';
    public function order(){
        return $this->belongsTo('App\Models\Order','order_id');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
