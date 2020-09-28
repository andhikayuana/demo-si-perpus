<?php

namespace App\Http\Controllers\Api\V1;

use App\Book;
use App\TrxBorrow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TrxBorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TrxBorrow::with([
                'member',
                'details.book'
            ])
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
            'members_id' => 'required|integer',
            'borrowed_at' => 'required|date',
            'due_return_at' => 'required|date',
            'books' => 'required|array',
            'books.*' => 'distinct'
        ]);

        $data = \DB::transaction(function () use ($request) {
            $trxBorrow = TrxBorrow::create($request->only([
                'members_id',
                'borrowed_at',
                'due_return_at'
            ]));

            $booksFound = Book::select('id')
                ->whereIn('id', $request->books)
                ->get()
                ->map(function ($book) {
                    return $book->id;
                });

            $booksNotFound = collect($request->books)->diff($booksFound);

            if ($booksNotFound->count() > 0) {
                throw ValidationException::withMessages([
                    'books' => 'books with id '.$booksNotFound->implode(', ').' not found'
                ]);
            }

            $trxBorrow->details()->createMany(
                collect($request->books)
                    ->map(function ($item) {
                        return [ 'books_id' => $item ];
                    })
                    ->all());

            $trxBorrow->load([
                'member',
                'details.book'
            ]);
            return $trxBorrow;
        });

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return TrxBorrow::with([
            'member',
            'details.book'
        ])->findOrFail($id);
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
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
