<?php

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
})->middleware('guest');

Route::resources([
    'tipo-usuarios' => App\Http\Controllers\TipoUsuarioControlador::class,
    'usuarios' => App\Http\Controllers\UsersController::class,
    'amigos' => App\Http\Controllers\AmigosController::class,
    'solicitudes' => App\Http\Controllers\SolicitudesController::class,
    'bloqueos' => App\Http\Controllers\BloqueosController::class,
    'salas' => App\Http\Controllers\SalasController::class,
    'tipo-salas' => App\Http\Controllers\TipoSalasController::class,
    'visiblidad-salas' => App\Http\Controllers\VisibilidadSalasController::class,
    'detale-salas' => App\Http\Controllers\DetalleSalasController::class,
    'mensajes' => App\Http\Controllers\MensajesController::class,
    'tipo-mensajes' => App\Http\Controllers\TipoMensajesController::class,
]);

Route::get('mensajes/{id}', [App\Http\Controllers\MensajesController::class, 'show']);
Route::delete('/delsolicitudes', [App\Http\Controllers\SolicitudesController::class, 'borrar']);
Route::delete('/delamigos', [App\Http\Controllers\AmigosController::class, 'borrar']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
