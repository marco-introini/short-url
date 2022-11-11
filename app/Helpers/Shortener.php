<?php

namespace App\Helpers;

use App\Exceptions\BadUrlException;
use App\Models\Url;
use Illuminate\Support\Facades\Http;

class Shortener
{

    protected static string $chars = "abcdfghjkmnpqrstvwxyz|ABCDFGHJKLMNPQRSTVWXYZ|0123456789";

    protected static function verifyUrlExists($url): bool
    {
        return (Http::get($url)->successful());
    }

    protected static function generateRandomString(int $length): string
    {
        $sets = explode('|', self::$chars);
        $all = '';
        $randString = '';
        foreach ($sets as $set) {
            $randString .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++) {
            $randString .= $all[array_rand($all)];
        }
        return str_shuffle($randString);
    }


    /**
     * @throws BadUrlException
     */
    public static function shorten(string $url): string
    {
        if ((config('shorturl.validate_url')) && !self::verifyUrlExists($url)) {
            throw new BadUrlException("$url does not exist");
        }

        $shortUrl = self::generateRandomString(config('shorturl.max-length', 7));

        while (Url::where('short_url_string', 'LIKE',$url)->count() == 1){
            $shortUrl = self::generateRandomString(config('shorturl.max-length', 7));
        }

        return $shortUrl;
    }
}
