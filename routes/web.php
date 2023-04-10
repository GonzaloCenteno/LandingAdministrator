<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\GeneralController;
use App\Http\Controllers\Landing\AhorrosController;
use App\Http\Controllers\Landing\CreditosController;
use App\Http\Controllers\Administracion\LandingController;
use App\Http\Controllers\Administracion\DepartamentoController;
use App\Http\Controllers\Administracion\DistritoController;
use App\Http\Controllers\Administracion\FormularioController;

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
    return view('auth.login');
})->name('main');

Route::get('/creditos', [CreditosController::class, 'index']);
Route::get('/ahorros', [AhorrosController::class, 'index']);
Route::get('/general', [GeneralController::class, 'index']);

Auth::routes();

Route::middleware(['auth','acceso'])->group(function () {
	Route::resource('landing', LandingController::class);
    Route::resource('departamento', DepartamentoController::class);
    Route::resource('distrito', DistritoController::class);
    Route::resource('formulario', FormularioController::class);
});



