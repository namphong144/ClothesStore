<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function orderDetail(){
        return $this ->HasMany(OrderDetails::class, 'order_id', 'id');
    }

    public function payment(){
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    public function admin(){
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}