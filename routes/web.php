<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\RequestUserController;

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

Route::get('/', [IndexController::class, 'index'])->name('/');
Route::get('request', [RequestUserController::class, 'index'])->name('request_user');

// Sex Start
    Route::get('/requestUser', [RequestUserController::class, 'index'])->name('requestUser');
    Route::post('/request_create', [RequestUserController::class, 'request_create'])->name('request_create');
    Route::get('/requestUserFetchAll', [RequestUserController::class, 'request_fetch_all'])->name('requestUserFetchAll');
    // Route::delete('/requestUserDelete', [RequestUserController::class, 'requestUserDelete'])->name('requestUserDelete');
    Route::get('/request_fetch_one', [RequestUserController::class, 'request_fetch_one'])->name('request_fetch_one');
    Route::post('/request_update', [RequestUserController::class, 'request_update'])->name('request_update');
    Route::get('/request_detail', [RequestUserController::class, 'request_detail'])->name('request_detail');
// Sex End

Route::get('test', [TestController::class, 'index']);
