<?php

namespace App\Http\Controllers;

use App\Helpers\Shortener;
use App\Http\Requests\UrlRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use App\Traits\BaseApiResponse;
use Exception;
use Illuminate\Http\Request;

class UrlApiController extends Controller
{
    use BaseApiResponse;

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
        if (!$this->checkCorrectUser($url)) {
            return $this->sendErrorResponse(null,'URL Not Found',404);
        }

        $url->original_url = $request->url;
        $url->save();

        return new UrlResource($url);
    }

    public function destroy(Url $url)
    {
        if (!$this->checkCorrectUser($url)) {
            return $this->sendErrorResponse(null,'URL Not Found',404);
        }

        try {
            $url->deleteOrFail();
        }
        catch (Exception $e) {
            return $this->sendErrorResponse(null,'URL Not Found',500);
        }

        return response('',204);
    }

    public function show(Url $url)
    {
        if (!$this->checkCorrectUser($url)) {
            return $this->sendErrorResponse(null,'URL Not Found',404);
        }
        return new UrlResource($url);
    }

    protected function checkCorrectUser(Url $url): bool
    {
        return ($url->user_id == auth()->user()->id);
    }
}