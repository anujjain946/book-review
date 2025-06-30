<?php

namespace Database\Seeders;
use App\Models\Review;
use App\Models\Book;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $books = Book::factory()->count(20)->create();

        // Then, create reviews for each book
        foreach ($books as $book) {
            Review::factory()->count(5)->create([
                'book_id' => $book->id, // Use the existing book's ID
            ]);
        }
    }
}
