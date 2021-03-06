<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlacesController;
use App\Http\Controllers\NexusEventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlaceRegistrationController;
use App\Http\Controllers\AlertingController;

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
Route::get('/nexus/500', [NexusEventController::class, 'serverError'])->name('500');

Route::middleware(['guest'])->group(function () {
    Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'storeLogin']);
    Route::get('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/register', [AuthController::class, 'storeRegister']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'user', 'middleware' => 'auth.role:' . \App\Models\User::ROLE_USER_CUSTOMER], function () {
        Route::get('/dashboard', [UserController::class, 'dashboard']);

        Route::get('/profile', [UserController::class, 'profile']);
        Route::post('/profile', [UserController::class, 'storeProfile']);

        Route::post('place-registration/{id}/checkout', [PlaceRegistrationController::class, 'checkout'])->name('place-registration.checkout');
        Route::post('alerting/{id}/resolve', [AlertingController::class, 'resolve'])->name('alerting.resolve');

        Route::resource('place-registration', PlaceRegistrationController::class);
        Route::resource('alerting', AlertingController::class);
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'auth.role:' . \App\Models\User::ROLE_USER_ADMIN], function () {
        Route::resource('places', PlacesController::class);

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });
    });
});