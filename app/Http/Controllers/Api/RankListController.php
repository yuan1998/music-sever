<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RankList;
use Illuminate\Http\Request;

class RankListController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {

        $query = RankList::query();
        if ($id = $request->get('songListId')) {
            $query->where('songListId', $id);
        }
        $data = $query->avg('score');
        return response()->json($data);
    }

    public function add(Request $request)
    {

        $data = $request->all();
        $exists = RankList::query()
            ->where('songListId' , $data['songListId'])
            ->where('consumerId' , $data['consumerId'])
            ->exists();
        if (!$exists) {
            RankList::create($data);
        }

        return response()->json([
            'code' => 1,
        ]);
    }
}
