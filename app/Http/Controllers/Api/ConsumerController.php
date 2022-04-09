<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consumer;
use Illuminate\Http\Request;

class ConsumerController extends Controller
{
    public function detail(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->get('id');

        $user = Consumer::with(['collectSong'])
            ->where('id', $id)
            ->first();

        return response()->json($user);
    }


}
