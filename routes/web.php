<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\GrupoUsuarioController;
use App\Http\Controllers\Limpiar;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/limpiar', [Limpiar::class, 'limpiar'])->name('limpiar');
Route::get('/crear/acceso', [Limpiar::class, 'acceso'])->name('acceso');
Auth::routes();

Route::group([
    'middleware' => 'auth',
], function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/users', UsuarioController::class)->names('user');
    Route::resource('/roles', GrupoUsuarioController::class)->names('role');
    Route::resource('/alumnos', AlumnoController::class)->names('alumno');
    Route::resource('/documentos-curso', DocumentoController::class)->names('documento');

});

