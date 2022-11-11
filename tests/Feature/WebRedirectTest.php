<?php


use App\Models\User;

it('can redirect to a defined url', function () {

    User::factory()->create();
    $url = \App\Models\Url::factory(1)->create()->first();

    $response = $this->get(route('redirect',['short' => $url->short_url_string]));

    $response->assertRedirect($url->original_url);
});