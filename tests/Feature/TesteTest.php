<?php

it('has teste page', function () {
    $response = $this->get('/teste');

    $response->assertStatus(200);
});
