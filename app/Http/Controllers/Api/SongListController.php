<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SongList;
use Illuminate\Http\Request;

class SongListController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $query = SongList::query()->limit(12);
        if ($style = $request->get('style')) $query->where('style', $style);

        $data = $query->get();
        return response()->json($data);
    }

    public function everDayPush() {


    }

    public function searchList(Request $request): \Illuminate\Http\JsonResponse
    {
        $name = $request->get('title');
        $likeName = '%' . $name . '%';
        $data = SongList::query()
            ->whereHas('song', function ($query) use ($likeName) {
                $query->where('name', 'like', $likeName);
            })
            ->orWhere('title', 'like', $likeName)
            ->orWhere('introduction', 'like', $likeName)
            ->orWhere('style', 'like', $likeName)
            ->get();

        return response()->json($data);
    }
}
