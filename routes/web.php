<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;



Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class)->names([
    'index'   => 'users.index',
    'create'  => 'users.create',
    'store'   => 'users.store',
    'edit'    => 'users.edit',
    'update'  => 'users.update',
    'destroy' => 'users.destroy',
]);


Auth::routes();

Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update.post');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
