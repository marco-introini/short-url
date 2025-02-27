<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Shortener;
use App\Http\Controllers\Controller;
use App\Http\Requests\UrlRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use App\Traits\BaseApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

class UrlApiController extends Controller
{
    use BaseApiResponse;

    /**
     * Get all Urls
     *
     * Get all Urls associated to logged user, with usage count and last 100 calls
     */
    public function index(Request $request)
    {
        return UrlResource::collection(
            Url::all()
        );
    }

    /**
     * Create an Url
     *
     * Create a new Url with short-url associated to logge-in user
     */
    public function store(UrlRequest $request)
    {
        $url = Url::create([
            'original_url' => $request->url,
            'short_url_string' => Shortener::shorten($request->url),
            'user_id' => $request->user()->id,
        ]);

        return new UrlResource($url);
    }

    /**
     * Update an Url
     *
     * Update a single Url associated to the user
     */
    public function update(UrlRequest $request, Url $url)
    {
        if (!$this->checkCorrectUser($url)) {
            return $this->sendErrorResponse(null,'URL Not Found',404);
        }

        $url->original_url = $request->url;
        $url->save();

        return new UrlResource($url);
    }

    /**
     * Delete an Url
     *
     * Delete a single Url associated to the user
     */
    public function destroy(Url $url)
    {
        if (!$this->checkCorrectUser($url)) {
            return $this->sendErrorResponse(null,'URL Not Found',404);
        }

        try {
            $url->deleteOrFail();
        }
        catch (Exception|Throwable) {
            return $this->sendErrorResponse(null,'URL Not Found',500);
        }

        return response('',204);
    }

    /**
     * Get a single Url
     *
     * Get a single Urls associated to logged user, with usage count and last 100 calls
     *
     * @param  Url  $url
     * @return UrlResource|JsonResponse
     */
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
