<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
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
}