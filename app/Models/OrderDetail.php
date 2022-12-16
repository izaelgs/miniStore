<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'phone',
        'street',
        'number',
        'city',
        'state',
        'zipcode',
        'complement',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
