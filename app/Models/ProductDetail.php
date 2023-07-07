<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table = 'product_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function size(){
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    public function orderDetail(){
        return $this ->HasMany(OrderDetails::class, 'product_detail_id', 'id');
    }
}