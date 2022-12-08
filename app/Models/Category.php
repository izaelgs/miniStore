<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoryid',
        'title',
        'description',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }


    // Autorelacionamento
        public function categories()
        {
            return $this->hasMany(Category::class, 'categoryid', 'id');
        }

        public function category()
        {
            return $this->belongsTo(Category::class, 'categoryid', 'id');
        }

        public function isFather()
        {
            return is_null($this->attributes['categoryid']);
        }

        protected $appends = ['is_father'];
        public function getIsFatherAttribute()
        {
            return is_null($this->attributes['categoryid']);
        }
}
