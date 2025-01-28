<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\GrupoUsuarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Limpiar;
use App\Http\Controllers\PadreController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VerificarController;
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
Route::get('/logout', [LoginController::class, 'logout']);

Route::group([
    'middleware' => 'auth',
], function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/users', UsuarioController::class)->names('user');
    Route::resource('/roles', GrupoUsuarioController::class)->names('role');
    Route::resource('/alumnos', AlumnoController::class)->names('alumno');
    Route::resource('/documentos-curso', DocumentoController::class)->names('documento');

    Route::get('/padres-registro', [PadreController::class, 'create'])->name('padre.create');

    Route::get('/padres-verificar', [VerificarController::class, 'index'])->name('verificar.index');
    Route::get('/padres-verificar/{padreAlumno}/aprobar', [VerificarController::class, 'aprobar'])->name('verificar.aprobar');
    Route::get('/padres-verificar/{padreAlumno}/rechazar', [VerificarController::class, 'rechazar'])->name('verificar.rechazar');
    Route::get('/padres-registro/verificados', [VerificarController::class, 'verificados'])->name('verificar.verificados');
    Route::get('/padres-registro/rechazados', [VerificarController::class, 'rechazados'])->name('verificar.rechazados');

    Route::post('documentos-registrarVista', [HomeController::class, 'registrarVista'])->name('documentos.registrarVista');

    Route::get('/consulta', [ConsultaController::class, 'index'])->name('consulta.index');


});

