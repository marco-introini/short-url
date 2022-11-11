<?php

namespace App\Http\Controllers;

use App\Helpers\Shortener;
use App\Http\Requests\UrlRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use Illuminate\Http\Request;

class UrlApiController extends Controller
{
    public function index(Request $request)
    {
        return UrlResource::collection(
            Url::where('user_id','=',$request->user()->id)->get()
        );
    }

    public function store(UrlRequest $request)
    {
        $url = Url::create([
            'original_url' => $request->url,
            'short_url_string' => Shortener::shorten($request->url),
            'user_id' => $request->user()->id,
        ]);

        return new UrlResource($url);
    }

    public function update(UrlRequest $request, Url $url)
    {
    }

    public function destroy(Url $url)
    {
    }
}