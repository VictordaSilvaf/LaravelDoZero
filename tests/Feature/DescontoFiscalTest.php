<?php

use App\Models\User;

it('has descontofiscal page', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get('/dashboard/proposta/cadastrar');
    $response->assertOK();
});
