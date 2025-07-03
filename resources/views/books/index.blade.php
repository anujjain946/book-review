@extends('layouts.app')

@section('content')
  <div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h3 mb-0">Books</h1>
      <a href="{{ route('books.index') }}" class="btn btn-outline-primary">Reset Filters</a>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('books.index') }}" class="mb-4">
      <div class="row g-2">
        <div class="col-md-8">
          <input type="text" name="search" class="form-control" placeholder="Search books...">
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
      </div>
    </form>

    <div class="row">
      @forelse ($books as $book)
        <div class="col-md-6 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="row g-0 h-100">
              <!-- Left section: Book details -->
              <div class="col-8 d-flex flex-column p-3">
                <h5 class="card-title mb-1">
                  <a href="{{ route('books.show', $book) }}" class="text-decoration-none">
                    {{ $book->title }}
                  </a>
                </h5>
                <h6 class="card-subtitle text-muted mb-2">
                  by {{ $book->author }}
                </h6>

                {{-- ⭐ Replaced with star icons --}}
                @php
                  $rating = round($book->reviews_avg_rating, 1);
                  $fullStars = floor($rating);
                  $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
                  $emptyStars = 5 - $fullStars - $halfStar;
                @endphp

                <p class="mb-2">
                  @for ($i = 0; $i < $fullStars; $i++)
                    <i class="fas fa-star text-warning"></i>
                  @endfor
                  @if ($halfStar)
                    <i class="fas fa-star-half-alt text-warning"></i>
                  @endif
                  @for ($i = 0; $i < $emptyStars; $i++)
                    <i class="far fa-star text-warning"></i>
                  @endfor

                  <small class="text-muted">
                    ({{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }})
                  </small>
                </p>

                <div class="mt-auto">
                  <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm">View Details</a>
                </div>
              </div>

              <!-- Right section: Rating badge or image -->
              <div class="col-4 d-flex justify-content-center align-items-center bg-light">
                <div class="text-center">
                  <span class="display-6 fw-bold text-primary">
                    {{ number_format($book->reviews_avg_rating, 1) }}
                  </span>
                  <div class="small text-muted">Rating</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="alert alert-info text-center">
            No books found.
          </div>
        </div>
      @endforelse
    </div>

    {{-- Example Pagination --}}
    @if (method_exists($books, 'links'))
      <div class="d-flex justify-content-center">
        {{ $books->links() }}
      </div>
    @endif
  </div>
@endsection
