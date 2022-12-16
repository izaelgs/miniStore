<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fisrt_name',
        'last_name',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
