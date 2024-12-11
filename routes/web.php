<?php

use Illuminate\Support\Facades\Route;

// Controller Auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Controller Mahasiswa
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Mahasiswa\MoodController;
use App\Http\Controllers\Mahasiswa\ProgressTrackerController;
use App\Http\Controllers\Mahasiswa\MoodCalendarController;
use App\Http\Controllers\Mahasiswa\ReportController;
use App\Http\Controllers\Mahasiswa\MahasiswaNotifController;

// Controller Dosen
use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Dosen\DosenHomeController;
use App\Http\Controllers\Dosen\DosenNotifController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\Dosen\DosenCreateUserController;

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

// ------------------------ Landing Page ------------------------- //

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/navbar/navbar1', function () {
    return view('navbar.navbar1');
});

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('redirectifauthenticated');

Route::get('/home', function () {
    return view('home');
})->name('home');

// ------------------------ Dosen Routes ------------------------- //

Route::middleware(['dosen'])->group(function () {
    Route::get('/navbar/navbar2', function () {
        return view('navbar.navbar2');
    });

    Route::get('/navbar/navbar-dosen', function () {
        return view('navbar.navbar-dosen');
    });



    // Dosen Prefix Routes
    Route::prefix('dosen')->group(function () {
        Route::get('/home', [DosenHomeController::class, 'index'])->name('dosen.home');
        Route::get('/search', [DosenHomeController::class, 'search'])->name('dosen.search');
        Route::get('/mahasiswa/delete/{id}', [DosenHomeController::class, 'destroy'])->name('dosen.delete');
        Route::post('/edit-role/{id}', [DosenHomeController::class, 'editRole']);
        Route::post('/mahasiswa/{mahasiswaId}/izin', [DosenHomeController::class, 'sendPermissionRequest'])->name('dosen.izin');

        Route::get('/create-user', [DosenCreateUserController::class, 'create'])->name('dosen.create-user');
        Route::post('/users', [DosenCreateUserController::class, 'store']);

        Route::get('/notifikasi', [DosenNotifController::class, 'showNotifications'])->name('dosen.notifikasi');
        Route::get('dosen/download-pdf/{notificationId}', [DosenNotifController::class, 'downloadPDF'])->name('dosen.downloadPDF');

        Route::get('/profil', [DosenController::class, 'showProfil'])->name('dosen.profil');
        Route::post('/update-profil', [DosenController::class, 'updateProfil'])->name('dosen.updateProfil');
        Route::get('/edit-profil', [DosenController::class, 'bukaEdit'])->name('dosen.edit-profil');
    });
});

// ------------------------ Mahasiswa Routes ------------------------- //
Route::middleware(['mahasiswa'])->group(function () {
    Route::get('/navbar/navbar3', function () {
        return view('navbar.navbar3');
    });

    Route::get('/navbar/navbar-mahasiswa', function () {
        return view('navbar.navbar-mahasiswa');
    });

    Route::get('/mahasiswa/landingPage', function () {
        return view('mahasiswa.landingPage');
    })->name('mahasiswa.landingPage');

    Route::get('/mahasiswa/calendar', [MoodCalendarController::class, 'calendar'])->name('mahasiswa.calendar');
    Route::get('/mahasiswa/notes', function () {
        return view('mahasiswa.notes');
    })->name('mahasiswa.notes');

    Route::get('/mahasiswa/edit-mood-notes', [MoodCalendarController::class, 'showEditMoodsDanNotes'])->name('mahasiswa.edit-mood-notes');
    Route::post('/update-mood-note/{id}', [MoodCalendarController::class, 'updateMoodNote'])->name('updateMoodNote');

    Route::get('/mahasiswa/report', [ReportController::class, 'index'])->name('mahasiswa.report');
    Route::get('/mahasiswa/notifikasi', [MahasiswaNotifController::class, 'index'])->name('mahasiswa.notifikasi');
    Route::post('/mahasiswa/notifikasi/{id}', [MahasiswaNotifController::class, 'update'])->name('mahasiswa.notifikasi.update');
    Route::get('/mahasiswa/profil', [MahasiswaController::class, 'showProfil'])->name('mahasiswa.profil');
    Route::post('/mahasiswa/update-profil', [MahasiswaController::class, 'updateProfil'])->name('mahasiswa.updateProfil');
    Route::get('/mahasiswa/edit-profil', [MahasiswaController::class, 'bukaEdit'])->name('mahasiswa.edit-profil');
    Route::get('/mahasiswa/home', function () {
        return view('mahasiswa.home');
    })->name('mahasiswa.home');

    // Kembali Route
    Route::get('/kembali', function () {
        session()->forget('selectedEmotion');
        session()->forget('selectedIntensity');
        return redirect()->route('mahasiswa.home');
    })->name('mahasiswa.kembali');

    // Mood Routes
    Route::get('/mahasiswa/notes', [MoodController::class, 'showNotes'])->name('mahasiswa.notes');
    Route::post('/mahasiswa/store-mood', [MoodController::class, 'storeMood'])->name('mahasiswa.storeMood');

    // Progress Routes
    Route::post('/progress/store', [ProgressTrackerController::class, 'store'])->name('progress.store');
});


// ------------------------ Auth Routes ------------------------- //

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/store/mahasiswa', [RegisterController::class, 'storeMahasiswa'])->name('store.mahasiswa');
Route::post('/store/dosen', [RegisterController::class, 'storeDosen'])->name('store.dosen');

// ------------------------ Register Routes ------------------------- //

Route::get('/dosen/register', function () {
    return view('dosen.register');
})->name('dosen.register');

Route::get('/mahasiswa/register', function () {
    return view('mahasiswa.register');
})->name('mahasiswa.register');

// ------------------------ OTP Routes ------------------------- //

Route::get('/otp-verification', [OTPController::class, 'otpVerificationForm'])->name('otp-verification');
Route::post('/otp-verification', [OTPController::class, 'verifyOTP'])->name('verify-otp');
Route::post('/resend-otp', [OTPController::class, 'resendOtp'])->name('resend-otp');
Route::post('/check-otp-status', [OTPController::class, 'checkOtpStatus'])->name('check-otp-status');
