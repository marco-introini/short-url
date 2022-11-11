<?php

namespace Database\Factories;

use App\Helpers\Shortener;
use App\Models\Url;
use Illuminate\Database\Eloquent\Factories\Factory;

class UrlFactory extends Factory
{
    protected $model = Url::class;

    public function definition(): array
    {
        $originalUrl = fake()->url();

        return [
            'original_url' => $originalUrl,
            'short_url_string' => Shortener::shorten($originalUrl),
        ];
    }
}
