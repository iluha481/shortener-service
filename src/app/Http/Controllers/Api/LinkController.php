<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLinkRequest;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use App\Models\Link;

class LinkController extends Controller
{
    public function store(StoreLinkRequest $request)
    {
        $url = $request->validated()['url'];

        $exsisting = Link::where('url', $url)->first();  
        if ($exsisting) {
            return response()->json([
                'code' => $exsisting->code,
                'short_url' => $exsisting->url,
            ]);
        }

        $code = substr(md5($url . time()), 0, 6);
        

        $link = Link::create([
            'url' => $url,
            'code' => $code,
        ]);

        return response()->json([
            'code' => $link->code,
            'short_url' => $link->url,
        ], 201);
    }
}
