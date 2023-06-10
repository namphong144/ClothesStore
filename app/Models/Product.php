<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'id');
    }

    public function productImage(){
        return $this ->HasMany(ProductImage::class, 'product_id', 'id');
    }

    public function productDetail(){
        return $this ->HasMany(ProductDetail::class, 'product_id', 'id');
    }

    public function productComment(){
        return $this ->HasMany(ProductComment::class, 'product_id', 'id');
    }

    public function orderDetail(){
        return $this ->HasMany(OrderDetail::class, 'product_id', 'id');
    }

    public function product_size(){
        return $this ->HasMany(Product_Size::class, 'product_id', 'id');
    }
}