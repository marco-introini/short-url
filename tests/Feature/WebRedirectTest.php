<?php

use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Url;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

it('can redirect to a defined url', function () {

    User::factory()->create();
    $url = Url::factory(1)->create()->first();

    $response = $this->get(route('redirect',['short' => $url->short_url_string]));

    $response->assertRedirect($url->original_url);
});

test('a call increase url calls', function () {

    User::factory()->create();
    $url = Url::factory(1)->create()->first();

    $response = $this->get(route('redirect',['short' => $url->short_url_string]));

    assertDatabaseCount('url_calls',1);
    assertDatabaseHas('url_calls',['url_id' => $url->id]);

    $response->assertRedirect($url->original_url);
});