<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'img_url',
        'price',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}