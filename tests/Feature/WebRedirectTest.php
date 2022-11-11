<?php


it('can redirect to a defined url', function () {


    $response = $this->get('/r');

    $response->assertStatus(200);
});