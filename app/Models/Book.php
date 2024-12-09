<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BooksToAuthors;
use App\Models\Author;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = ['name'];
    protected $with = ['books_to_authors'];
    protected $appends = ['authors'];

    public function books_to_authors()
    {
        return $this->hasMany(BooksToAuthors::class, 'book_id', 'id');
    }

    public function getAuthorsAttribute()
    {
        $authors_ids = $this->books_to_authors->pluck('author_id');
        return Author::whereIn('id', $authors_ids)->get();
    }
}
