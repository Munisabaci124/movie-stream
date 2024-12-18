<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'release_year', 'category_id', 'thumbnail_url'];

    /**
     * Relasi: Satu film memiliki satu kategori.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi: Satu film memiliki satu detail film.
     */
    public function detail()
    {
        return $this->hasOne(MovieDetail::class);
    }
}
