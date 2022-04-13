<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collect;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->only([
            "user_id",
            "type",
            "song_id",
        ]);

        $exists = Collect::query()
            ->where('user_id', $data['user_id'])
            ->where('song_id', $data['song_id'])
            ->where('type', $data['type'])
            ->exists();

        if ($exists) {
            return response()
                ->json([
                    'code' => 2,
                ]);
        }

        Collect::create($data);

        return response()
            ->json([
                'code' => 1,
            ]);
    }

}
