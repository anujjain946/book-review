<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'book_id' => null,
        //     'review' =>fake()->paragraph,
        //     'rating' =>fake()->numberBetween(1,5),
        //     'created_at'=>dateTimeBetween('-2 years'),
        //     'updated_at'=>dateTimeBetween('created_at','now'),
        // ];
        $rating = $this->faker->numberBetween(1, 5);

        // Use rating to decide review text
        if ($rating <= 2) {
            $reviewText = 'Bad';
        } elseif ($rating == 3) {
            $reviewText = 'Average';
        } else {
            $reviewText = 'Good';
        }

        return [
            'book_id' => Book::factory(),
            'review' => $reviewText,
            'rating' => $rating,
           // 'created_at'=>dateTimeBetween('-2 years'),
           // 'updated_at'=>dateTimeBetween('created_at','now'),
        ];
    }
}
