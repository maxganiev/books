<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BooksToAuthors extends Model
{
    protected $table = 'books_to_authors';
    protected $fillable = ['book_id', 'author_id'];
}
