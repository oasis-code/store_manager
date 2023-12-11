<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin/users', [UserController::class, 'user'])->name('admin.users.index');
Route::get('/admin/users/create', [UserController::class, 'createUser'])->name('admin.users.create');
Route::post('/admin/users', [UserController::class, 'storeUser'])->name('admin.users.store');
Route::get('/admin/users/{nowuser}/edit', [UserController::class, 'editUser'])->name('admin.users.edit');
Route::put('/admin/users/{nowuser}', [UserController::class, 'updateUser'])->name('admin.users.update');