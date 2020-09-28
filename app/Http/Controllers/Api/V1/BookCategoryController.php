<?php

namespace App\Http\Controllers\Api\V1;

use App\BookCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookCategory::orderByDesc('id')->paginate(10);
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
            'name' => 'required'
        ]);

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bookCategory = BookCategory::findOrFail($id);

        if ($request->has('name')) {
            $request->validate([
                'name' => 'required'
            ]);
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
