<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\DosenHomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenCreateUserController;

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
// ------------------------ lading page utama ------------------------- //

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',function(){
    return view('login');
})-> name('login');

Route::get('/home', function () {
    return view('home');
})->name('home');


// ------------------------ lading page utama ------------------------- //



// ------------------------ route untuk dosen ------------------------- //
Route::get('/dosen/otp', function() { return view('dosen.otp'); })->name('dosen.otp');
Route::get('/navbar/navbar-dosen', function() { return view('navbar.navbar-dosen'); });
Route::get('/dosen/home', function() { return view('dosen.home'); })->name('dosen.home');
Route::get('/dosen/profil', function() { return view('dosen.profil'); })->name('dosen.profil');
Route::get('/dosen/register', function() { return view('dosen.register'); })->name('dosen.register');
Route::get('/dosen/notifikasi', function() { return view('dosen.notifikasi'); })->name('dosen.notifikasi');
Route::get('/dosen/edit-profil', function() { return view('dosen.edit-profil'); })->name('dosen.edit-profil');
Route::get('/dosen/create-user', function() { return view('dosen.create-user'); })->name('dosen.create-user');

Route::prefix('dosen')->group(function () {
    Route::get('/home', [DosenHomeController::class, 'index'])->name('dosen.home');
    Route::get('/search', [DosenHomeController::class, 'search'])->name('dosen.search');
    Route::get('/mahasiswa/delete/{id}', [DosenHomeController::class, 'destroy'])->name('dosen.delete');
    Route::post('/edit-role/{id}', [DosenHomeController::class, 'editRole']);
});

Route::post('/create-user', [CreateUserController::class, 'store'])->name('create-user');



// ------------------------ route untuk dosen ------------------------- //


// ------------------------ route untuk mahasiswa ------------------------- //

Route::get('/navbar/navbar-mahasiswa', function() { return view('navbar.navbar-mahasiswa'); });
Route::get('/mahasiswa/home', function() { return view('mahasiswa.home'); })->name('mahasiswa.home');
Route::get('/mahasiswa/notes', function() { return view('mahasiswa.notes'); })->name('mahasiswa.notes');
Route::get('/mahasiswa/report', function() { return view('mahasiswa.report'); })->name('mahasiswa.report');
Route::get('/mahasiswa/profil', function() { return view('mahasiswa.profil'); })->name('mahasiswa.profil');
Route::get('/mahasiswa/register', function() { return view('mahasiswa.register'); })->name('mahasiswa.register');
Route::get('/mahasiswa/notifikasi', function() { return view('mahasiswa.notifikasi'); })->name('mahasiswa.notifikasi');
Route::get('/mahasiswa/edit-profil', function() { return view('mahasiswa.edit-profil'); })->name('mahasiswa.edit-profil');
Route::get('/mahasiswa/view-mood-calendar', function() { return view('mahasiswa.calender'); })->name('mahasiswa.calender');
Route::get('/mahasiswa/edit-mood-dan-notes', function() { return view('mahasiswa.edit-mood-notes'); })->name('mahasiswa.edit-mood-notes');


// ------------------------ route login register ------------------------- //
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/store/mahasiswa', [RegisterController::class, 'storeMahasiswa'])->name('store.mahasiswa');
Route::post('/store/dosen', [RegisterController::class, 'storeDosen'])->name('store.dosen');


// ------------------------ route login register ------------------------- //


// ------------------------ route untuk OTP ------------------------- //
// Route::post('/post-email', [SendEmailController::class, 'store'])->name('post-email');
// ------------------------ route untuk OTP ------------------------- //




