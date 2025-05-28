<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;

use app\Http\Controllers\Api\Dosen\DosenController;
use App\Http\Controllers\Api\Dosen\DosenCreateUserController;
use App\Http\Controllers\Api\Dosen\DosenNotifCOntroller;
use App\Http\Controllers\Api\Dosen\DosenHomeController;

use App\Http\Controllers\Api\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Api\Mahasiswa\MahasiswaNotifController;
use App\Http\Controllers\Api\Mahasiswa\MoodController;
use App\Http\Controllers\api\Mahasiswa\ProgressTrackerController;
use App\Http\Controllers\Api\Mahasiswa\ReportController;
use App\Http\Controllers\Api\Mahasiswa\MoodCalendarController;

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

Route::middleware(['auth:sanctum', 'mahasiswa'])->group(function() {
    Route::get('/mahasiswa/profil', [MahasiswaController::class, 'showProfil']);
    Route::put('/mahasiswa/update-profil', [MahasiswaController::class, 'updateProfil']);

    Route::post('/mahasiswa/store-mood', [MoodController::class, 'storeMood']);
    Route::post('/mahasiswa/progress/store', [ProgressTrackerController::class, 'store']);

    Route::get('/mahasiswa/notifikasi', [MahasiswaNotifController::class, 'index']);
    Route::put('/mahasiswa/notifikasi/{id}', [MahasiswaNotifController::class, 'update']);

    Route::get('/mahasiswa/report', [ReportController::class, 'getReportData']);

    Route::get('/mahasiswa/calendar', [MoodCalendarController::class, 'calendar']);
    Route::get('/mahasiswa/edit-mood-notes', [MoodCalendarController::class, 'showEditMoodsDanNotes']);
    Route::put('/mahasiswa/update-mood-note/{id}', [MoodCalendarController::class, 'updateMoodNote']);
});



Route::middleware(['auth:sanctum', 'dosen'])->group(function() {
    Route::get('/dosen/profil', [DosenController::class, 'showProfil']);
    Route::put('/dosen/update-profil', [DosenController::class, 'updateProfil']);

    Route::post('/dosen/create-user/store', [DosenCreateUserController::class, 'storeUserManualAPI']);
    Route::post('/dosen/create-user/import', [DosenCreateUserController::class, 'importUserExcelAPI']);

    Route::get('/dosen/notifikasi', [DosenNotifCOntroller::class, 'showNotifications']);
    Route::get('/dosen/download-pdf/{id}', [DosenNotifController::class, 'downloadPDF']);

    Route::get('/dosen/home', [DosenHomeController::class, 'index']);
    Route::get('/dosen/search', [DosenHomeController::class, 'search']);
    Route::post('/dosen/mahasiswa/{mahasiswaId}/izin', [DosenHomeController::class, 'sendPermissionRequest']);
    Route::delete('/dosen/delete-mahasiswa/{id}', [DosenHomeController::class, 'destroy']);
});
