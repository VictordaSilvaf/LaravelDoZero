<?php


it('check if home page is working')
    ->get('/')
    ->assertOk();

it('check if SpashScreen Component was rendered', function () {
    $this->get('/')->assertSeeLivewire('components.splash-screen');
});
