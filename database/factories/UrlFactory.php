<?php

namespace Database\Factories;

use App\Helpers\Shortener;
use App\Models\Url;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Url>
 */
class UrlFactory extends Factory
{
    protected $model = Url::class;

    public function definition(): array
    {
        $originalUrl = fake()->url();
        $user = User::inRandomOrder()->first();

        return [
            'name' => fake()->words(3, true),
            'original_url' => fake()->url(),
            'short_url_string' => Shortener::shorten($originalUrl),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
        ];
    }
}
