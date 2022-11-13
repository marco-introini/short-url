<?php

namespace Database\Factories;

use App\Models\UrlCall;
use App\Models\Url;
use Illuminate\Database\Eloquent\Factories\Factory;

class UrlCallFactory extends Factory
{
    protected $model = UrlCall::class;

    public function definition(): array
    {
        return [
            'url_id' => Url::inRandomOrder()->first(),
            'ip_address' => $this->faker->ipv4(),
        ];
    }
}
