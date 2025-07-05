<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;
use App\Models\Book;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      
        $filter     = $request->input('filter', '');
        $title      = $request->input('title');
        $booksQuery = Book::query();
        
        // Optional title filter
        $booksQuery = $booksQuery->when(
            $title,
            fn ($query, $title) => $query->title($title)
        );
        
        
        // Apply filter
        $booksQuery = match ($filter) {
            'popular_last_month' => $booksQuery->popularLastMonth(),
            'popular_last_6months' => $booksQuery->popularLast6Months(),
            'highest_rated_last_month' => $booksQuery->highestRatedLastMonth(),
            'highest_rated_last_6months' => $booksQuery->highestRatedLast6Months(),
            default => $booksQuery->latest(),
        };

        // Paginate at the end
        // $books = $booksQuery->paginate(10);
        $books = $booksQuery->popular()->get();
       // $books=dd($booksQuery->toSql());
       //   dd($this->getFinalQuery($booksQuery));
        return view('books.index', ['books' => $books]);
    }


    function getFinalQuery($query)
    {
        $sql = $query->toSql();
        $bindings = $query->getBindings();
        return vsprintf(str_replace('?', "'%s'", $sql), $bindings);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    public function show(Book $book)
    {
        // $book = Book::findOrFail($id);
        // return view(
        //     'books.show',
        //     ['book'=>$book->load([
        //         'reviews'=>fn($query) =>$query->latest()
        //     ])
        // ]); 

        $bookData = Cache::remember(
            'book_' . $book->id,
            now()->addMinutes(30),
            fn () => $book->load(['reviews' => fn ($q) => $q->latest()])
        );  


        $book = Book::findOrFail($book->id);
        return view(
            'books.show',
            ['book'=>$bookData
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
