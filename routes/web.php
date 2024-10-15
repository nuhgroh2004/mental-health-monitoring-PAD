<?php

use Illuminate\Support\Facades\Route;
use Mews\Captcha\Captcha;
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
    return view('landingPage');
})->name('landingPage');

Route::get('/navbar/navbar1',function(){
    return view('navbar.navbar1');
});

Route::get('/login',function(){
    return view('login');
})-> name('login');

// ------------------------ lading page utama ------------------------- //



// ------------------------ route untuk dosen ------------------------- //

Route::get('/navbar/navbar2',function(){
    return view('navbar.navbar2');
});

Route::get('/dosen/register',function(){
    return view('dosen.register');
})->name('dosen.register');

Route::get('/dosen/landingPage',function(){
    return view('dosen.landingPage');
})->name('dosen.landingPage');

Route::get('/dosen/createUser',function(){
    return view('dosen.createUser');
})->name('dosen.createUser');

Route::get('/dosen/notifikasi',function(){
    return view('dosen.notifikasi');
})->name('dosen.notifikasi');

Route::get('/dosen/profil',function(){
    return view('dosen.profil');
})->name('dosen.profil');

Route::get('/dosen/editProfil',function(){
    return view('dosen.editProfil');
})->name('dosen.editProfil');

Route::get('/dosen/otp',function(){
    return view('dosen.otp');
})->name('dosen.otp');


// ------------------------ route untuk dosen ------------------------- //


// ------------------------ route untuk mahasiswa ------------------------- //

Route::get('/navbar/navbar3',function(){
    return view('navbar.navbar3');
});

Route::get('/mahasiswa/register',function(){
    return view('mahasiswa.register');
})->name('mahasiswa.register');

Route::get('/mahasiswa/landingPage',function(){
    return view('mahasiswa.landingPage');
})->name('mahasiswa.landingPage');

Route::get('/mahasiswa/viewMoodCalendar',function(){
    return view('mahasiswa.viewMoodCalendar');
})->name('mahasiswa.viewMoodCalendar');

Route::get('/mahasiswa/notes',function(){
    return view('mahasiswa.notes');
})->name('mahasiswa.notes');

Route::get('/mahasiswa/editMoodDanNotes',function(){
    return view('mahasiswa.editMoodDanNotes');
})->name('mahasiswa.editMoodDanNotes');

Route::get('/mahasiswa/report',function(){
    return view('mahasiswa.report');
})->name('mahasiswa.report');

Route::get('/mahasiswa/notifikasi',function(){
    return view('mahasiswa.notifikasi');
})->name('mahasiswa.notifikasi');

Route::get('/mahasiswa/profil',function(){
    return view('mahasiswa.profil');
})->name('mahasiswa.profil');

Route::get('/mahasiswa/editProfil',function(){
    return view('mahasiswa.editProfil');
})->name('mahasiswa.editProfil');
// ------------------------ route untuk mahasiswa ------------------------- //


// Route::get('/captcha/refresh', function() {
//     return response()->json(['captcha'=> captcha_img('flat')]);
// });



