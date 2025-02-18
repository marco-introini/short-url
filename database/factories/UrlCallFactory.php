<?php

namespace Database\Factories;

use App\Models\Scopes\UrlByUserScope;
use App\Models\UrlCall;
use App\Models\Url;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UrlCall>
 */
class UrlCallFactory extends Factory
{
    protected $model = UrlCall::class;

    public function definition(): array
    {
        return [
            'url_id' => Url::withoutGlobalScope(UrlByUserScope::class)
                ->inRandomOrder()->first(),
            'ip_address' => fake()->ipv4(),
        ];
    }
}
