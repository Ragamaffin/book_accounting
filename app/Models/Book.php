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
        'user_id',
        'genre_id',
        'author',
        'year',
        'description',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function genre(){
        return $this->hasOne(Genre::class);
    }
}
