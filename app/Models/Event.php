<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Review;
use App\Models\Organization;

class Event extends Model
{
    protected $fillable = [
        'organization_id',
        'category_id',
        'title',
        'description',
        'date',
        'location',
        'price',
        'stock',
        'poster_path',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relasi ke Organization
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}