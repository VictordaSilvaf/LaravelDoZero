<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Components\SplashScreen;
use App\Http\Livewire\Pages\Desconto\DescontoCreate;
use App\Http\Livewire\Pages\Desconto\DescontoIndex;
use App\Http\Livewire\Pages\Desconto\DescontoUpdate;
use App\Http\Livewire\Pages\Home;
use App\Http\Livewire\Pages\Produtos;
use App\Http\Livewire\Pages\Proposta\PropostaCreate;
use App\Http\Livewire\Pages\Proposta\Show;
use App\Http\Livewire\Pages\Propostas;
use App\Http\Livewire\Pc\ShowClient;
use App\Http\Livewire\Testes;
use App\Models\Cliente;
use App\Models\Pagamento;
use App\Models\Produto;
use Illuminate\Support\Facades\Route;

Route::get('/', SplashScreen::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('registrar', Register::class)
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

    Route::get('logout', LogoutController::class)
        ->name('logout');
});

/* Dashboard Geral */
Route::middleware('auth')->group(function () {
    Route::get('dashboard/home', Home::class)
        ->name('dashboard.home');

    Route::get('dashboard/produtos', Produtos::class)
        ->name('dashboard.produtos');

    Route::post('dashboard/produtos/adicionar', [Produtos::class, 'adicionarProduto'])
        ->name('dashboard.produtos.adicionar');

    Route::get('dashboard/produtos/remover/{id}', [Produtos::class, 'removerAnuncio'])->name('produtos.remover');

    Route::get('dashboard/produtos/export', [Produtos::class, 'export'])->name('produtos.exportar');
    Route::post('dashboard/produtos/import', [Produtos::class, 'import'])->name('produtos.importar');
});

/* Desconto */
Route::middleware('auth')->group(function () {
    Route::any('dashboard/descontos', DescontoIndex::class)
        ->name('descontos.index');

    Route::get('dashboard/descontos/create', DescontoCreate::class)
        ->name('descontos.create');

    Route::get('dashboard/descontos/update/{id}', DescontoUpdate::class)
        ->name('descontos.update');

    Route::post('dashboard/descontos/store2', [DescontoUpdate::class, 'update'])
        ->name('descontos.update2');

    Route::post('dashboard/descontos/store', [DescontoCreate::class, 'store'])
        ->name('descontos.store');

    Route::delete('dashboard/descontos/destroy/{id}', [DescontoIndex::class, 'destroy'])
        ->name('descontos.destroy');

    Route::get('dashboard/descontos/export', [DescontoIndex::class, 'export'])->name('descontos.exportar');
    Route::post('dashboard/descontos/import', [DescontoIndex::class, 'import'])->name('descontos.importar');
});

/* Proposta */
Route::middleware('auth')->group(function () {
    Route::any('dashboard/propostas', Propostas::class)->name('propostas.index');

    Route::get('dashboard/proposta/cadastrar', PropostaCreate::class)->name('proposta.create');

    Route::post('dashboard/proposta/buscar', [ShowClient::class, 'buscarClienteBling'])->name('proposta.buscarBling');

    Route::get('dashboard/propostas/estado/{id}/{estado}', [Propostas::class, 'mudarEstadoPC'])
        ->name('proposta.estado');

    Route::get('dashboard/proposta/visualizar/{id}', Show::class)->name('proposta.show');

    Route::get('dashboard/pdf/{id}', [Show::class, 'imprimirPDF'])->name('proposta.pdf');

    Route::get('dashboard/pdf/enviar/{id}', [Show::class, 'enviarPDFEmail'])->name('proposta.enviarpdf');
});

Route::get('produtos', function () {
    dd(Produto::all()->where('descricaoComplementar', '<p>C-Vendas</p>' && 'estrutura' == null)->where('grupoProduto', 'ST Nacional')->random());
});

Route::get('clientes', function () {
    dd(Cliente::all()->where('uf', 'RN')->where('contribuinte', '1')->random());
});

Route::get('pagamentos', function () {
    dd(Pagamento::all());
});

Route::get('test', Testes::class)->name('test');
