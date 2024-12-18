<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieDetail extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id', 'description', 'duration', 'rating'];

    /**
     * Relasi: Satu detail film hanya terkait dengan satu film.
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
