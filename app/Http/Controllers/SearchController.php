<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function provinces()
    {
        if (request('id')) {
            $province = Province::where('id', request('id'))->get();
            return response()->json([
                'success' => true,
                'result' => $province,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'ID not provided'
            ], 401);
        }
    }

    public function cities()
    {
        if (request('id')) {
            $city = City::where('id', request('id'))->get();
            return response()->json([
                'success' => true,
                'result' => $city,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'ID not provided'
            ], 401);
        }
    }
}
