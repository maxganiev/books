<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BooksToAuthors;


class Author extends Model
{
    protected $table = 'authors';
    protected $fillable = ['first_name', 'last_name'];
    protected $with = ['books'];

    public function books()
    {
        return $this->hasMany(BooksToAuthors::class, 'author_id', 'id');
    }
}
