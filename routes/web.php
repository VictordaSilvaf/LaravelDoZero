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
use App\Http\Livewire\Pages\Desconto\DescontoCreate;
use App\Http\Livewire\Pages\Desconto\DescontoIndex;
use App\Http\Livewire\Pages\Home;
use App\Http\Livewire\Pages\Produtos;
use App\Http\Livewire\Pages\Proposta\PropostaCreate;
use App\Http\Livewire\Pages\Proposta\Show;
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

/* Dashboard Geral */
Route::middleware('auth')->group(function () {
    Route::get('dashboard/home', Home::class)
        ->name('dashboard.home');

    Route::get('dashboard/produtos', Produtos::class)
        ->name('dashboard.produtos');
});

/* Desconto */
Route::middleware('auth')->group(function () {
    Route::get('dashboard/descontos', DescontoIndex::class)
        ->name('descontos.index');

    Route::get('dashboard/descontos/create', DescontoCreate::class)
        ->name('descontos.create');

    Route::post('dashboard/descontos/store', [DescontoCreate::class, 'store'])
        ->name('descontos.store');

    Route::delete('dashboard/descontos/destroy/{id}', [DescontoIndex::class, 'destroy'])
        ->name('descontos.destroy');

    Route::get('dashboard/descontos/export/', [DescontoIndex::class, 'export']);
});

/* Proposta */
Route::middleware('auth')->group(function () {
    Route::resource('dashboard/propostas', Propostas::class);

    Route::get('dashboard/proposta/cadastrar', PropostaCreate::class)->name('proposta.create');

    Route::get('dashboard/propostas/estado/{id}/{estado}', [Propostas::class, 'mudarEstadoPC'])
        ->name('proposta.estado');

    Route::get('dashboard/proposta/{id}', Show::class)->name('proposta.show');
});

Route::get('produtos', function () {
    dd(Produto::all()->where('grupoProduto', 'Nacional')->first());
});

Route::get('clientes', function () {
    dd(Cliente::all()->where('contribuinte', '1')->where('uf', 'RJ')->first()->cnpj);
});

Route::get('pagamentos', function () {
    dd(Pagamento::all());
});
