<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    public $timestamps =false;
    protected $fillable = [
        'shipping_name', 'shipping_address', 'email', 'shipping_number', 'notes', 'shipping_payment'
    ];
    protected $primaryKey = 'shipping_id';
    protected $table = 'shipping';
}
