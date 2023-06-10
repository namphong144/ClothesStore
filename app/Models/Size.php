<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'sizes';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function product_size(){
        return $this ->HasMany(Product_Detail::class, 'size_id', 'id');
    }

}