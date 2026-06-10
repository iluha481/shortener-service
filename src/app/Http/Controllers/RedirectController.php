<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class RedirectController extends Controller
{
    public function redirect($code)
    {
        $link = Link::where('code', $code)->first();
        if (!$link) {
            abort(404);
        }
        $link->increment('clicks');
        return redirect($link->url, 302);
    }
}
