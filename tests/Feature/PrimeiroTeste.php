<?php

it('has primeiroteste page', function () {
    $response = $this->get('/primeiroteste');

    $response->assertStatus(200);
});
