<?php

use App\Models\UrlCall;
use App\Models\User;
use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

use function Pest\Faker\faker;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

uses(RefreshDatabase::class);

test('sanctum blocks not logged user', function () {
    $user = User::factory()->create();
    Url::factory(20)->create();

    $response = $this->get(route('url.index'), ['Accept' => 'application/json']);
    $response->assertUnauthorized();
});

it('can get all my urls', function () {
    $user = User::factory()->create();
    Url::factory(20)->create();

    Sanctum::actingAs($user);

    $response = $this->get(route('url.index'));
    $response->assertStatus(200);
    $response->assertJsonCount(20, 'data');
    $response->assertJsonFragment([
        'id' => Url::whereId(18)->first()->id,
        'original_url' => Url::whereId(18)->first()->original_url,
    ]);
});

it('can insert a new url', function () {
    $user = User::factory()->create();
    $newUrl = faker()->url;

    Sanctum::actingAs($user);

    $response = $this->post(route('url.store'), ['url' => $newUrl], ['Accept' => 'application/json']);
    $response->assertStatus(201);
    assertDatabaseHas('urls', ['original_url' => $newUrl]);
});

it('can delete an url', function () {
    $user = User::factory()->create();
    $url = Url::factory(['user_id' => $user->id])->create();

    Sanctum::actingAs($user);

    $response = $this->delete(route('url.destroy', ['url' => $url]), [], ['Accept' => 'application/json']);
    $response->assertStatus(204);
    assertDatabaseMissing('urls', ['original_url' => $url]);
});

it('cannot delete another user url', function () {
    $user = User::factory(2)->create();
    Url::factory(['user_id' => $user[0]->id])->create();
    $url = Url::factory(['user_id' => $user[1]->id])->create();

    Sanctum::actingAs($user[0]);

    $response = $this->delete(route('url.destroy', ['url' => $url]), [], ['Accept' => 'application/json']);
    $response->assertNotFound();
    assertDatabaseHas('urls', ['original_url' => $url->original_url]);
});

it('can update an url', function () {
    $user = User::factory()->create();
    $url = Url::factory(['user_id' => $user->id])->create();
    $newUrl = faker()->url;

    Sanctum::actingAs($user);

    $response = $this->patch(route('url.update', ['url' => $url]), ['url' => $newUrl], ['Accept' => 'application/json']
    );
    $response->assertStatus(200);
    $response->assertJsonFragment([
        'id' => $url->id,
        'original_url' => $newUrl,
    ]);
    assertDatabaseMissing('urls', ['original_url' => $url]);
    assertDatabaseHas('urls', ['original_url' => $newUrl]);
});

it('cannot update an url of another user', function () {
    $user = User::factory(2)->create();
    Url::factory(['user_id' => $user[0]->id])->create();
    $url = Url::factory(['user_id' => $user[1]->id])->create();
    $newUrl = faker()->url;

    Sanctum::actingAs($user[0]);

    $response = $this->patch(route('url.update', ['url' => $url]), ['url' => $newUrl], ['Accept' => 'application/json']);
    $response->assertNotFound();

    assertDatabaseMissing('urls', ['original_url' => $newUrl]);
});

it('can get a single url', function () {
    $user = User::factory()->create();
    $url = Url::factory(['user_id' => $user->id])->create();

    Sanctum::actingAs($user);

    $response = $this->get(route('url.show', ['url' => $url]), [], ['Accept' => 'application/json']);
    $response->assertStatus(200);
    $response->assertJsonFragment([
        'id' => $url->id,
        'original_url' => $url->original_url,
    ]);
});

test('the single url API returns call numbers and list', function () {
    $user = User::factory()->create();
    $url = Url::factory(['user_id' => $user->id])->create();
    UrlCall::factory(10, ['url_id' => $url->id])->create();

    $urlCall = UrlCall::inRandomOrder()->first();

    Sanctum::actingAs($user);

    $response = $this->get(route('url.show', ['url' => $url]), [], ['Accept' => 'application/json']);
    $response->assertStatus(200);
    $response->assertJsonFragment([
        'access_count' => UrlCall::where('url_id','=',$url->id)->count(),
    ]);
    $response->assertJsonFragment([
        'timestamp' => $urlCall->created_at,
        'ip_address' => $urlCall->ip_address,
    ]);
});

