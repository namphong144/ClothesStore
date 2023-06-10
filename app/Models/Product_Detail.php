<?php

namespace App\Models;

use App\Models\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product_Size extends Model
{
    use HasFactory;
    protected $table = 'product_details';

    public function size(){
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
}