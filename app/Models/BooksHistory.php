<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooksHistory extends Model
{
    use HasFactory;
    protected $table = 'books_histories';
    protected $fillable = [
        'user_id',
        'book_id',
        'take_date',
        'passed_date',
    ];


}
