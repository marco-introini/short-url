<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
    }

    public function show(Url $url)
    {
    }

    public function update(Request $request, Url $url)
    {
    }

    public function destroy(Url $url)
    {
    }
}