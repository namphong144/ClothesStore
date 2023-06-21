<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    
    protected $table = 'payment';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function order(){
        return $this ->HasMany(Order::class, 'payment_id', 'id');
    }
}