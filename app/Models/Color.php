<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function product_size(){
        return $this ->HasMany(Product_Detail::class, 'color_id', 'id');
    }

}