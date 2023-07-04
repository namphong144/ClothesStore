<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $table = 'statistics';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;

    protected $fillable = [
        'order_date',
        'sales',
        'profit',
        'total_order',
    ];
}