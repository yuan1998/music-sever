<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Consumer;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::query()
            ->orderBy('order')
            ->limit(5)
            ->get();

        return response()->json($banner);
    }

}
