<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TasksController; 
use App\Http\Controllers\MapaController;
use App\Http\Livewire\CarroController;
use App\Http\Livewire\EstacionamentoController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/tasks', TasksController::class);
    Route::resource('/users', UsersController::class);
    Route::resource('/mapa', MapaController::class);
    Route::get('/carro', CarroController::class)->name('carro');
    Route::get('/estacionamento', EstacionamentoController::class)->name('estacionamento');
});
