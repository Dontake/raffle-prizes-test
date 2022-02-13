<?php

use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Raffle\RaffleController;
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
Route::middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('raffle');
    });

    Route::prefix('raffle')->group(function () {
        Route::get('prize', [RaffleController::class, 'getPrize'])->name('get.raffle.prize');
    });

    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');
});

Route::post('login', [AuthController::class, 'login'])
    ->name('auth.login');

Route::get('auth', function () {
    return view('auth.login');
})->name('login');
