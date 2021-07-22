<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlacesController;
use App\Http\Controllers\NexusEventController;

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

Route::get('/nexus/401', [NexusEventController::class, 'unauthorized'])->name('401');

Route::middleware(['guest'])->group(function () {
    Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'storeLogin']);
    Route::get('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/register', [AuthController::class, 'storeRegister']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'auth.role:' . \App\Models\User::ROLE_USER_ADMIN], function () {
        Route::resource('places', PlacesController::class);
    });
});