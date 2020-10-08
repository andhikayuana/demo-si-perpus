<?php

namespace App\Http\Controllers\Api\V1;

use App\Book;
use App\BookCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'nullable',
            'total' => 'required|integer',
            'cover_url' => 'nullable|url',
            'book_categories_id' => 'required|integer'
        ]);

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        if ($request->has('title')) {
            $request->validate([
                'title' => 'required'
            ]);
            $book->title = $request->title;
        }

        if ($request->has('description')) {
            $book->description = $request->description;
        }

        if ($request->has('total')) {
            $request->validate([
                'total' => 'required|integer'
            ]);
            $book->total = $request->total;
        }

        if ($request->has('cover_url')) {
            $book->cover_url = $request->cover_url;
        }

        if ($request->has('book_categories_id')) {
            $request->validate([
                'book_categories_id' => 'required|integer'
            ]);
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
