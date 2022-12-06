<?php

use App\Models\UrlCall;
use Illuminate\Support\Facades\Route;
use App\Models\Url;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get("/r/{short}", function (string $short){
    $url = Url::where('short_url_string','LIKE',$short)->firstOrFail();
    UrlCall::create([
        'url_id' => $url->id,
        'ip_address' => request()->ip(),
    ])->save();
    return redirect($url->original_url);
})->name('redirect');
