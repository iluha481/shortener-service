<?php

namespace App\Http\Controllers\Api;
use Str;
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
                'short_url' => url('/' . $exsisting->code),
            ]);
        }


        do {
            $code = Str::random(6);
        } while (Link::where('code', $code)->exists());
        
        $link = Link::create([
            'url' => $url,
            'code' => $code,
        ]);

        return response()->json([
            'code' => $link->code,
            'short_url' => url('/' . $link->code),
        ], 201);
    }

    public function stats(string $code){
        $link = Link::where('code', $code)->first();
        if (!$link) {
            abort(404);
        }
        return response()->json([
            'url' => $link->url,
            'code' => $link->code,
            'clicks' => $link->clicks,
            'created_at' => $link->created_at->utc()->toISOString,
        ]);
    }
}
