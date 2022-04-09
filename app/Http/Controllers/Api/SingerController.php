<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Singer;
use Illuminate\Http\Request;

class SingerController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $query = Singer::query()->limit(8);
        $sex = $request->get('sex');
        if ($sex) $query->where('sex', $sex);
        $data = $query->get();

        return response()->json($data);
    }

}
