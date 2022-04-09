<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function commentOfSong(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->get('songId');
        $data = Comment::query()
            ->with(['user'])
            ->where('song_id', $id)
            ->get();

        return response()->json($data);
    }

    public function commentOfList(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->get('songListId');

        $data = Comment::query()
            ->with(['user'])
            ->where('song_list_id', $id)
            ->get();

        return response()->json($data);

    }

    public function addComment(Request $request)
    {
        $data = $request->only(["song_list_id",
            "song_id",
            "user_id",
            "type",
            "content"]);
        Comment::create($data);

        return response()->json([
            'code' => 1,
        ]);
    }

    public function likeComment(Request $request)
    {
        $id = $request->get('id');
        $up = $request->get('type');

        $comment = Comment::find($id);
        if ($up || $comment->up  <= 0) {
            $comment->increment('up');
        } else {
            $comment->decrement('up');
        }

        return response()->json([
            'code' => 1,
        ]);
    }
}
