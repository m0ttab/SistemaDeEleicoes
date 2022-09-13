<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeriodosController;
use App\Http\Controllers\EleitoresController;
use App\Http\Controllers\CandidatosController;


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

Route::get('/api/periodos', function(){

    $respostas = DB::select('select * from periodos');

    echo json_encode($respostas);

});
Route::get('/api/eleitores', function(){

    $respostas = DB::select('select * from eleitores');

    echo json_encode($respostas);

});
Route::get('/api/candidatos', function(){

    $respostas = DB::select('select * from candidatos');

    echo json_encode($respostas);

});

Route::get('/periodos', [PeriodosController::class, 'index']);
Route::get('/periodos/create', [PeriodosController::class, 'create']);
Route::post('/periodos/store', [PeriodosController::class, 'store']);
Route::get('/periodos/{id}/edit', [PeriodosController::class, 'edit']);
Route::post('/periodos/update', [PeriodosController::class, 'update']);
Route::get('/periodos/{id}/destroy', [PeriodosController::class, 'destroy']);

Route::get('/eleitores', [EleitoresController::class, 'index']);
Route::get('/eleitores/create', [EleitoresController::class, 'create']);
Route::post('/eleitores/store', [EleitoresController::class, 'store']);
Route::get('/eleitores/{id}/edit', [EleitoresController::class, 'edit']);
Route::post('/eleitores/update', [EleitoresController::class, 'update']);
Route::get('/eleitores/{id}/destroy', [EleitoresController::class, 'destroy']);

Route::get('/candidatos', [CandidatosController::class, 'index']);
Route::get('/candidatos/create', [CandidatosController::class, 'create']);
Route::post('/candidatos/store', [CandidatosController::class, 'store']);
Route::get('/candidatos/{id}/edit', [CandidatosController::class, 'edit']);
Route::post('/candidatos/update', [CandidatosController::class, 'update']);
Route::get('/candidatos/{id}/destroy', [CandidatosController::class, 'destroy']);
