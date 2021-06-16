<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', [\App\Http\Controllers\UsersController::class, 'buscarUsers']);

Route::post('/users', [\App\Http\Controllers\UsersController::class, 'inserirUser']);

Route::get('/users/{id}', [\App\Http\Controllers\UsersController::class, 'buscarUserPeloId']);

Route::put('/users/{id}', [\App\Http\Controllers\UsersController::class, 'atualizarUser']);

Route::delete('/users/{id}', [\App\Http\Controllers\UsersController::class, 'deletarUser']);


Route::get('/estudantes', [\App\Http\Controllers\EstudantesController::class, 'buscarEstudantes']);

Route::post('/estudantes', [\App\Http\Controllers\EstudantesController::class, 'inserirEstudante']);

Route::get('/estudantes/{id}', [\App\Http\Controllers\EstudantesController::class, 'buscarEstudantePeloId']);

Route::put('/estudantes/{id}', [\App\Http\Controllers\EstudantesController::class, 'atualizarEstudante']);

Route::delete('/estudantes/{id}', [\App\Http\Controllers\EstudantesController::class, 'deletarEstudante']);


Route::get('/carteirinhas', [\App\Http\Controllers\CarteirinhasController::class, 'buscarCarteirinhas']);

Route::post('/carteirinhas', [\App\Http\Controllers\CarteirinhasController::class, 'inserirCarteirinha']);

Route::get('/carteirinhas/{id}', [\App\Http\Controllers\CarteirinhasController::class, 'buscarCarteirinhaPeloId']);

Route::put('/carteirinhas/{id}', [\App\Http\Controllers\CarteirinhasController::class, 'atualizarCarteirinha']);

Route::delete('/carteirinhas/{id}', [\App\Http\Controllers\CarteirinhasController::class, 'deletarCarteirinha']);


Route::get('/eventos', [\App\Http\Controllers\EventosController::class, 'buscarEventos']);

Route::post('/eventos', [\App\Http\Controllers\EventosController::class, 'inserirEvento']);

Route::get('/eventos/{id}', [\App\Http\Controllers\EventosController::class, 'buscarEventoPeloId']);

Route::put('/eventos/{id}', [\App\Http\Controllers\EventosController::class, 'atualizarEvento']);

Route::delete('/eventos/{id}', [\App\Http\Controllers\EventosController::class, 'deletarEvento']);


Route::get('/produtos', [\App\Http\Controllers\ProdutosController::class, 'buscarProdutos']);

Route::post('/produtos', [\App\Http\Controllers\ProdutosController::class, 'inserirProduto']);

Route::get('/produtos/{id}', [\App\Http\Controllers\ProdutosController::class, 'buscarProdutoPeloId']);

Route::put('/produtos/{id}', [\App\Http\Controllers\ProdutosController::class, 'atualizarProduto']);

Route::delete('/produtos/{id}', [\App\Http\Controllers\ProdutosController::class, 'deletarProduto']);


Route::get('/responsaveis', [\App\Http\Controllers\ResponsaveisController::class, 'buscarResponsaveis']);

Route::post('/responsaveis', [\App\Http\Controllers\ResponsaveisController::class, 'inserirResponsavel']);

Route::get('/responsaveis/{id}', [\App\Http\Controllers\ResponsaveisController::class, 'buscarResponsavelPeloId']);

Route::put('/responsaveis/{id}', [\App\Http\Controllers\ResponsaveisController::class, 'atualizarResponsavel']);

Route::delete('/responsaveis/{id}', [\App\Http\Controllers\ResponsaveisController::class, 'deletarResponsavel']);


