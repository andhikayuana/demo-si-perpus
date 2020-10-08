<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', 'TestController@index');

Route::post('/auth/login', 'AuthController@login');

Route::group([
    'middleware' => ['auth:api']
], function () {
    Route::post('/auth/logout', 'AuthController@logout');
    Route::apiResources([
        'members' => 'MemberController',
        'book-categories' => 'BookCategoryController',
        'books' => 'BookController',
        'trx-borrows' => 'TrxBorrowController',
        'trx-returns' => 'TrxReturnController',
    ]);
});