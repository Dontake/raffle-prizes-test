<?php

use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Prize\PrizeController;
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
        return view('play');
    })->name('home');

    Route::prefix('prize')->group(function () {
        Route::get('play', [PrizeController::class, 'play'])->name('prize.play');
        Route::post('refuse', [PrizeController::class, 'refuse'])->name('prize.refuse');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::get('auth', function () {
    return view('auth.login');
})->name('login');
