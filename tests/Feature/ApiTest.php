<?php

use App\Models\User;
use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);


it('can get all my urls', function () {
    $user = User::factory()->create();
    Url::factory(20)->create();

    Sanctum::actingAs($user);

    $response = $this->get(route('url.index'));
    $response->assertStatus(200);
    $response->assertJsonCount(20,'data');
    $response->assertJsonFragment([
        'id' => Url::whereId(18)->first()->id,
        'original_url' => Url::whereId(18)->first()->original_url,
    ]);
});

test('sanctum blocks not logged user', function () {
    $user = User::factory()->create();
    Url::factory(20)->create();

    $response = $this->get(route('url.index'),['Accept' => 'application/json']);
    $response->assertUnauthorized();
});