<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;

use App\Http\Controllers\Api\Mahasiswa\MoodController;
use App\Http\Controllers\api\Mahasiswa\ProgressTrackerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);

Route::post('/register/mahasiswa', [RegisterController::class, 'storeMahasiswa']);
Route::post('/register/dosen', [RegisterController::class, 'storeDosen']);

Route::post('mood/store', [MoodController::class, 'storeMood']);

Route::post('progress/store', [ProgressTrackerController::class, 'store']);


