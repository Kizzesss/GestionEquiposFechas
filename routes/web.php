<?php

use App\Http\Controllers\PrestamoController;
use App\Models\Prestamo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MultasController;

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

Auth::routes();

Route::resource('prestamos', App\Http\Controllers\PrestamoController::class)->middleware('auth');
Route::resource('equipos', App\Http\Controllers\EquipoController::class)->middleware('auth');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/multas', [MultasController::class, 'index'])->name('multas.index');
Route::post('/multas', [MultasController::class, 'filtrar'])->name('multas.filtrar');


