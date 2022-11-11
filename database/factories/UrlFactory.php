<?php

namespace Database\Factories;

use App\Helpers\Shortener;
use App\Models\Url;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UrlFactory extends Factory
{
    protected $model = Url::class;

    public function definition(): array
    {
        $originalUrl = fake()->url();
        $user = User::inRandomOrder()->first();

        return [
            'original_url' => $originalUrl,
            'short_url_string' => Shortener::shorten($originalUrl),
            'user_id' => $user->id,
        ];
    }
}
