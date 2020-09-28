<?php

namespace App\Http\Controllers\Api\V1;

use App\TrxReturn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TrxReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TrxReturn::with([
                'trxBorrow.details.book',
                'trxBorrow.member'
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
            'trx_borrows_id' => 'required|integer'
        ]);

        $isReturned = TrxReturn::where('trx_borrows_id', $request->trx_borrows_id)->exists();

        if ($isReturned) {
            throw ValidationException::withMessages([
                    'trx_borrows_id' => 'already returned'
                ]);
        }

        return TrxReturn::create($request->only('trx_borrows_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return TrxReturn::with([
                'trxBorrow.details.book',
                'trxBorrow.member'
            ])
            ->findOrFail($id);
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
