<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;

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

//admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'user'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{nowuser}/edit', [UserController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{nowuser}', [UserController::class, 'updateUser'])->name('admin.users.update');
});


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('loggedin');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/dashboard/fuel', [AuthController::class, 'dashboard_fuel'])->name('dashboard.fuel')->middleware('auth');
// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Edit Profile Page
Route::get('/user/edit-profile', [AuthController::class, 'editProfile'])->name('user.edit-profile')->middleware('auth');
// Update Password
Route::post('/user/update-password', [AuthController::class, 'updatePassword'])->name('user.update-password')->middleware('auth');

//categories
Route::middleware(['auth'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
});

//vehicles
Route::middleware(['auth'])->group(function () {
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
});