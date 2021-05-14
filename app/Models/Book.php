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
}
