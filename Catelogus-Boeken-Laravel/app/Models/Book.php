<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'price', 'shelf_number',
        'cover_type', 'pages', 'language', 'publication_year',
        'publisher', 'author', 'stock', 'is_available'
    ];

    protected $attributes = [
        'stock' => 0,
        'is_available' => false,
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function images()
    {
        return $this->hasMany(BookImage::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function getPrimaryImageAttribute()
    {
        return $this->images()->where('is_primary', true)->first() ?? $this->images()->first();
    }

    public function getCanBeReservedAttribute()
    {
        return $this->stock > 0 && $this->is_available;
    }

    public function updateStock()
    {
        $this->is_available = $this->stock > 0;
        $this->save();
    }
}
