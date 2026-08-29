<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use App\Http\Controllers\MainController;

Route::middleware([CheckIsLogged::class])->group(function () {
    
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/autores', [AutorController::class, 'index'])->name('autores_index');
    Route::get('/new-autor', [AutorController::class, 'newAutor'])->name('new_autor');
    Route::post('/newAutorSubmit', [AutorController::class, 'newAutorSubmit'])->name('newAutorSubmit');
    Route::get('/edit-autor/{id}', [AutorController::class, 'editAutor'])->name('autores.edit');
    Route::post('/edit-autor-submit', [AutorController::class, 'editAutorSubmit'])->name('edit.autor.submit');
    Route::get('/delete-autor/{id}', [AutorController::class, 'deleteAutor'])->name('delete_autor');
    Route::get('/deleteAutorConfirm/{id}', [AutorController::class, 'deleteAutorConfirm'])->name('autores.delete.confirm');

    Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
    Route::get('/new-livro', [LivroController::class, 'newLivro'])->name('newLivro');
    Route::post('/newLivroSubmit', [LivroController::class, 'newLivroSubmit'])->name('newLivroSubmit');
    Route::get('/edit-livro/{id}', [LivroController::class, 'editLivro'])->name('edit.livro');
    Route::post('/edit-livro-submit', [LivroController::class, 'editLivroSubmit'])->name('edit.livro.submit');
    Route::get('/delete-livro/{id}', [LivroController::class, 'deleteLivro'])->name('delete.livro');
    Route::get('/deleteLivroConfirm/{id}', [LivroController::class, 'deleteLivroConfirm'])->name('deleteLivroConfirm');

});

Route::middleware([CheckIsNotLogged::class])->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'create'])->name('register');
});