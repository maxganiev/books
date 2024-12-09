<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Book;


class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $books = ['Grokking algorythms', 'Clean code', 'Laravel, 3rd edition'];


        DB::beginTransaction();
        foreach ($books as $book) {
            Book::create(['name' => $book]);
        }

        DB::table('books_to_authors')->insert(
            array(
                ['book_id' => 1, 'author_id' => 1],
                ['book_id' => 2, 'author_id' => 2],
                ['book_id' => 2, 'author_id' => 3],
                ['book_id' => 3, 'author_id' => 4],
                ['book_id' => 3, 'author_id' => 5],
                ['book_id' => 3, 'author_id' => 1]
            )
        );
        DB::commit();
    }
}
