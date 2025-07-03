<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    // Local scope to filter by title
    public function scopeTitle($query, $title)
    {
        return $query->where('title', 'like', "%{$title}%");
    }

    
   // Local scope to popular count
   public function scopePopular($query, $from = null, $to = null)
   {
       return $query
       ->dateRange($from, $to)
       ->withCount('reviews')
       ->orderBy('reviews_count', 'desc');
   }
  
    // Local scope to scopeHeihestRated
    public function scopeHighestRated($query, $from = null, $to = null)
    {
        return $query->withAvg('reviews', 'rating')
        ->dateRange($from, $to)
        ->orderBy('reviews_avg_rating', 'desc');
    }

    public function scopeMinReviews($query, $min = 1)
    {
        return $query
        ->withCount('reviews')
        ->having('reviews_count', '>=', $min);
    }
     
   // Local scope to scopeDateRange
   public function scopeDateRange($query, $from = null, $to = null)
   {
       if ($from && $to) {
           return $query->whereBetween('created_at', [$from, $to]);
       }
       // If no dates given, return query unchanged
       return $query;
   }
    
}   
