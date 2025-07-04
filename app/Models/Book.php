<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function scopeTitle($query, $title)
    {
        return $query->where('title', 'like', "%{$title}%");
    }


    public function scopePopular($query, $from = null, $to = null)
    {
        return $query
            ->dateRange($from, $to)
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->groupBy('books.id') // count + avg => safe
            ->orderBy('reviews_count', 'desc');
    }


    public function scopeHighestRated($query, $from = null, $to = null)
    {
        return $query
            ->dateRange($from, $to)
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->groupBy('books.id') 
            ->orderBy('reviews_avg_rating', 'desc');
    }

    
    public function scopeMinReviews($query, $min = 1)
    {
        return $query
            ->withCount('reviews')
            ->groupBy('books.id') // count + having => safe
            ->having('reviews_count', '>=', $min);
    }


    public function scopeDateRange($query, $from = null, $to = null)
    {
        if ($from && $to) {
            return $query->whereBetween('created_at', [$from, $to]);
        }
        return $query;
    }


    public function scopePopularLastMonth($query)
    {
        $from = now()->subMonth();
        $to = now();


        return $query->popular($from, $to)
                     ->highestRated($from, $to)
                     ->minReviews(2);
    }


    public function scopePopularLast6Months($query)
    {
        $from = now()->subMonths(6);
        $to = now();

        return $query->popular($from, $to)
                     ->highestRated($from, $to)
                     ->minReviews(5);
    }


    public function scopeHighestRatedLastMonth($query)
    {
        $from = now()->subMonth();
        $to = now();

        return $query->highestRated($from, $to)
                     ->popular($from, $to)
                     ->minReviews(2);
    }

 
    public function scopeHighestRatedLast6Months($query)
    {
        $from = now()->subMonths(6);
        $to = now();

        return $query->highestRated($from, $to)
                     ->popular($from, $to)
                     ->minReviews(5);
    }
}
