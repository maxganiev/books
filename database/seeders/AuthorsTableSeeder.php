<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = array(
            ['first_name' => 'Aditya Y.', 'last_name' => 'Bhargava'],
            ['first_name' => 'Robert', 'last_name' => 'Martin'],
            ['first_name' => 'Matt', 'last_name' => 'Staffer'],
            ['first_name' => 'John', 'last_name' => 'Doe'],
            ['first_name' => 'Lorem', 'last_name' => 'Impsum'],
            ['first_name' => 'Foo', 'last_name' => 'Barevich'],
        );

        foreach ($authors as $author) {
            Author::create(
                ['first_name' => $author['first_name'], 'last_name' => $author['last_name']]
            );
        }
    }
}
