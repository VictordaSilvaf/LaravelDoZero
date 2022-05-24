<?php

it('has primeiroteste page', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});
