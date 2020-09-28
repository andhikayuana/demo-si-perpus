<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'message' => 'Test API'
        ], 200);
    }
}
