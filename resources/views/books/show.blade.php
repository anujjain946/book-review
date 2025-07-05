@extends('layouts.app')

@section('content')
<div class="container my-5">
  <h1>{{ $book->title }}</h1>
  <h5 class="text-muted">by {{ $book->author }}</h5>

  @php
    $averageRating = $book->reviews->avg('rating');
  @endphp

  <p><strong>Average Rating:</strong> {{ number_format($averageRating, 1) }}</p>

  <hr>
  <h3>Reviews</h3>

  @forelse ($book->reviews as $review)
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title mb-1">Rating: {{ $review->rating }} ⭐</h5>
        <p class="card-text">{{ $review->review }}</p>
        <small class="text-muted">Reviewed on {{ $review->created_at->format('M d, Y') }}</small>
      </div>
    </div>
  @empty
    <div class="alert alert-info">No reviews yet.</div>
  @endforelse

  <a href="{{ route('index') }}" class="btn btn-outline-primary mt-4">Back to Books</a>
</div>
@endsection
