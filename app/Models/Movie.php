<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'movies';
    protected $fillable = ['title', 'year', 'runtime', 'description', 'image_url', 'director', 'age_restriction', 'cast'];
    
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }

    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }
}
