<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function searchSong(Request $request)
    {
        $name = $request->get('name');
        $data = Song::query()
            ->where('name', 'like', '%' . $name . '%')
            ->orWhere('introduction', 'like', '%' . $name . '%')
            ->get();

        return response()->json($data);
    }

    public function songOfSinger(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->get('singerId');
        $data = Song::query()
            ->where('singer_id', $id)
            ->limit(20)
            ->get();

        return response()->json($data);
    }

    public function songOfList(Request $request)
    {
        $id = $request->get('songListId');
        if ($id === 'everday') {
            $data = Song::getEverDaySong();
        } else {
            $data = Song::query()
                ->whereHas('songList', function ($query) use ($id) {
                    $query->where('song_list_id', $id);
                })
                ->get();
        }


        return response()->json($data);
    }

}
