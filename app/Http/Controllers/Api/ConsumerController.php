<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consumer;
use Illuminate\Http\Request;

class ConsumerController extends Controller
{

    public function search(Request $request)
    {
        $q = $request->get('q');
        $query = Consumer::query()
            ->select([
                'username',
                'id',
            ]);

        if ($q)
            $query->where('username', 'like', "%$q%");

        $list = $query->get();


        return response()->json([
            'code' => 1,
            'data' => $list,
        ]);

    }

    public function update(Request $request)
    {
        $data = $request->all();
        $id = $request->get('id');
        if (isset($data['password']))
            $data['password'] = bcrypt($data['password']);

        Consumer::query()
            ->where('id', $id)
            ->update($data);
        return response()->json([
            'code' => 1,
        ]);
    }


    public function detail(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->get('id');

        $user = Consumer::with(['collectSong'])
            ->where('id', $id)
            ->first();

        return response()->json($user);
    }

    public function interest(Request $request)
    {
        $id = $request->get('id');
        $interest = $request->get('interest');
        $model = Consumer::query()
            ->where('id', $id)
            ->update([
                'interest' => $interest
            ]);

        return response()->json([
            'code' => 1,
            'data' => $model,
        ]);
    }

    public function signUp(Request $request)
    {
        $data = $request->all();
        $username = $data['username'];

        $exists = Consumer::query()
            ->where('username', $username)
            ->exists();

        if ($exists)
            return response()->json([
                'code' => 1,
                'msg' => '注册失败,用户名已被注册',
                'type' => 'error',
            ]);

        $data['password'] = bcrypt($data['password']);
        Consumer::create($data);

        return response()->json([
            'code' => 1,
            'msg' => '注册成功',
            'type' => 'success',
            'success' => 1,
        ]);

    }


}
