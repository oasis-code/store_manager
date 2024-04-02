<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChemicalController;
use App\Http\Controllers\FuelTransactionController;
use App\Http\Controllers\LubTransactionController;
use App\Http\Controllers\LubController;

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

//operators
Route::middleware(['auth'])->group(function () {
    Route::get('/operators', [PeopleController::class, 'index_operator'])->name('operators.index');
    Route::get('/operators/create', [PeopleController::class, 'create_operator'])->name('operators.create');
    Route::post('/operators', [PeopleController::class, 'store_operator'])->name('operators.store');
    Route::get('/operators/{operator}/edit', [PeopleController::class, 'edit_operator'])->name('operators.edit');
    Route::put('/operators/{operator}', [PeopleController::class, 'update_operator'])->name('operators.update');
});

//drivers
Route::middleware(['auth'])->group(function () {
    Route::get('/drivers', [PeopleController::class, 'index_driver'])->name('drivers.index');
    Route::get('/drivers/create', [PeopleController::class, 'create_driver'])->name('drivers.create');
    Route::post('/drivers', [PeopleController::class, 'store_driver'])->name('drivers.store');
    Route::get('/drivers/{driver}/edit', [PeopleController::class, 'edit_driver'])->name('drivers.edit');
    Route::put('/drivers/{driver}', [PeopleController::class, 'update_driver'])->name('drivers.update');
});

//fuel
Route::middleware(['auth'])->group(function () {
    Route::get('/fuel-in', [FuelTransactionController::class, 'index_fuel_in'])->name('fuel-in.index');
    Route::get('/fuel-in-report', [FuelTransactionController::class, 'report_fuel_in'])->name('fuel-in.report');
    Route::get('/fuel-in/create', [FuelTransactionController::class, 'create_fuel_in'])->name('fuel-in.create');
    Route::post('/fuel-in', [FuelTransactionController::class, 'store_fuel_in'])->name('fuel-in.store');
    Route::post('/reverse-fuel-in', [FuelTransactionController::class, 'reverse_fuel_in'])->name('fuel-in.reverse');
    Route::get('/fuel-out', [FuelTransactionController::class, 'index_fuel_out'])->name('fuel-out.index');
    Route::get('/fuel-out-report', [FuelTransactionController::class, 'report_fuel_out'])->name('fuel-out.report');
    Route::get('/fuel-out-report-sum', [FuelTransactionController::class, 'report_fuel_out_sum'])->name('fuel-out.report-sum');
    Route::get('/fuel-out/create', [FuelTransactionController::class, 'create_fuel_out'])->name('fuel-out.create');
    Route::post('/fuel-out', [FuelTransactionController::class, 'store_fuel_out'])->name('fuel-out.store');
    Route::post('/reverse-fuel-out', [FuelTransactionController::class, 'reverse_fuel_out'])->name('fuel-out.reverse');
   
});

//Lubs
Route::middleware(['auth'])->group(function () {
    Route::get('/lubs', [LubController::class, 'index'])->name('lubs.index');
    Route::get('/lubs/create', [LubController::class, 'create'])->name('lubs.create');
    Route::post('/lubs', [LubController::class, 'store'])->name('lubs.store');
    Route::get('/lubs/{lub}/edit', [LubController::class, 'edit'])->name('lubs.edit');
    Route::put('/lubs/{lub}', [LubController::class, 'update'])->name('lubs.update');
});

//lub in
Route::middleware(['auth'])->group(function () {
    Route::get('/lub-in', [LubTransactionController::class, 'index_lub_in'])->name('lub-in.index');
    Route::get('/lub-in-report', [LubTransactionController::class, 'report_lub_in'])->name('lub-in.report');
    Route::get('/lub-in/create', [LubTransactionController::class, 'create_lub_in'])->name('lub-in.create');
    Route::post('/lub-in', [LubTransactionController::class, 'store_lub_in'])->name('lub-in.store');
    Route::get('/lub-out', [LubTransactionController::class, 'index_lub_out'])->name('lub-out.index');
    Route::get('/lub-out-report', [LubTransactionController::class, 'report_lub_out'])->name('lub-out.report');
    Route::get('/lub-out/create', [LubTransactionController::class, 'create_lub_out'])->name('lub-out.create');
    Route::post('/lub-out', [LubTransactionController::class, 'store_lub_out'])->name('lub-out.store');
   
});

//Chemical
Route::middleware(['auth'])->group(function () {
    Route::get('/chemicals', [ChemicalController::class, 'index'])->name('chemicals.index');
    Route::get('/chemicals/create', [ChemicalController::class, 'create'])->name('chemicals.create');
    Route::post('/chemicals', [ChemicalController::class, 'store'])->name('chemicals.store');
    Route::get('/chemicals/{chemical}/edit', [ChemicalController::class, 'edit'])->name('chemicals.edit');
    Route::put('/chemicals/{chemical}', [ChemicalController::class, 'update'])->name('chemicals.update');
});