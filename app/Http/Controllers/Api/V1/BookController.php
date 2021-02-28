<?php

namespace App\Http\Controllers\Api\V1;

use App\Book;
use App\BookCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::with('category')
            ->orderByDesc('id')
            ->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BookStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        return Book::create($request->only([
            'title',
            'description',
            'total',
            'cover_url',
            'book_categories_id'
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::with('category')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BookUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, $id)
    {
        $book = Book::findOrFail($id);

        if ($request->has('title')) {
            $book->title = $request->title;
        }

        if ($request->has('description')) {
            $book->description = $request->description;
        }

        if ($request->has('total')) {
            $book->total = $request->total;
        }

        if ($request->has('cover_url')) {
            $book->cover_url = $request->cover_url;
        }

        if ($request->has('book_categories_id')) {
            $book->book_categories_id = $request->book_categories_id;
        }

        $book->save();
        $book->load('category');

        return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::findOrFail($id)->delete();

        return response()->json([
            'message' => 'success delete the data'
        ], 200);
    }
}
