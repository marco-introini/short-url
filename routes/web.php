<?php

use Illuminate\Support\Facades\Route;
use App\Models\Url;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/r/{short}", function (string $short){
    $url = Url::where('short_url_string','LIKE',$short)->firstOrFail();
    //echo "redirect to ".$url->original_url;
    return redirect($url->original_url);
})->name('redirect');
