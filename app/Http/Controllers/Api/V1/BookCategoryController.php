<?php

namespace App\Http\Controllers\Api\V1;

use App\BookCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookCategoryStoreRequest;
use App\Http\Requests\BookCategoryUpdateRequest;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = BookCategory::query();

        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'LIKE', '%'.$request->name.'%');
        }
        return $query->orderByDesc('id')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BookCategoryStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookCategoryStoreRequest $request)
    {
        return BookCategory::create($request->only('name'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return BookCategory::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BookCategoryUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookCategoryUpdateRequest $request, $id)
    {
        $bookCategory = BookCategory::findOrFail($id);

        if ($request->has('name')) {
            $bookCategory->name = $request->name;
        }
        
        $bookCategory->save();
        
        return $bookCategory;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BookCategory::findOrFail($id)->delete();

        return response()->json([
            'message' => 'success delete the data'
        ], 200);
    }
}
