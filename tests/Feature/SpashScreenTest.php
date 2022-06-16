<?php


it('check if home page is working')
    ->get('/eunpego')
    ->assertOk();

it('check if SpashScreen Component was rendered', function () {
    $this->get('/')->assertSeeLivewire('components.splash-screen');
});
