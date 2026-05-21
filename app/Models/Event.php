<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'date',
        'location',
        'price',
        'stock',
        'poster_path'
    ];

    // 1 event dimiliki oleh 1 kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}