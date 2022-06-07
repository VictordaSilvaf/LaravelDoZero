<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Propostas;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Components\SplashScreen;
use App\Http\Livewire\Pages\Descontos;
use App\Http\Livewire\Pages\Home;
use App\Http\Livewire\Pages\Produtos;
use App\Http\Livewire\Pages\Proposta\PropostaCreate;
use App\Models\Cliente;
use App\Models\Pagamento;
use App\Models\Produto;
use Illuminate\Support\Facades\Route;

Route::get('/', SplashScreen::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

/* My routes */
Route::middleware('auth')->group(function () {
    Route::get('dashboard/home', Home::class)
        ->name('dashboard.home');

    Route::get('dashboard/produtos', Produtos::class)
        ->name('dashboard.produtos');

    Route::get('dashboard/descontos', Descontos::class)
        ->name('dashboard.descontos');

    Route::get('dashboard/descontos', Descontos::class)
        ->name('dashboard.descontos');

    Route::get('dashboard/proposta/cadastrar', PropostaCreate::class)->name('proposta.create');

    Route::resource('dashboard/propostas', Propostas::class);
});

Route::get('produtos', function () {
    dd(Produto::all());
});

Route::get('clientes', function () {
    dd(Cliente::all());
});

Route::get('pagamentos', function () {
    dd(Pagamento::all());
});
