<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = [
        'name',
        'name_id',
        'genre_id',
        'author',
        'year',
        'description',
    ];

    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    public function userbooks(){
        return $this->hasMany(UserBook::class);
    }

    public function similarBooks()
    {
        return $this->hasMany(Book::class, 'name_id', 'name_id');
    }

    public function getImagePath()
    {
        if (!$this->image_name) {
            return 'https://via.placeholder.com/220';
        }

        return asset('uploads/books/'.$this->image_name);
    }
}
