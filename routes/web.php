<?php

use App\Http\Controllers\PagCompleto\Integracao;
use App\Http\Controllers\PagCompleto\PedidosSituacaoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('clientes', App\Http\Controllers\PagCompleto\ClientesController::class);
Route::resource('formas-pagamento', App\Http\Controllers\PagCompleto\FormasPagamentoController::class);
Route::resource('pedidos-pagamento', App\Http\Controllers\PagCompleto\PedidosPagamentosController::class);
Route::resource('pedidos-situacao', App\Http\Controllers\PagCompleto\PedidosSituacaoController::class);
Route::resource('pedidos', App\Http\Controllers\PagCompleto\PedidosController::class);
Route::resource('gateways', App\Http\Controllers\PagCompleto\GatewaysController::class);
Route::resource('lojas-gateway', App\Http\Controllers\PagCompleto\LojasGatewaysController::class);
Route::get('integracao', [Integracao::class, 'transacaoLojas'])->name('integracao');



