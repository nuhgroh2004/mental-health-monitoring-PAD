@extends('navbar/navbar1')
@section('content')
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>GamaPulse</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicons -->
    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<title>Login</title>

<!-- Section Utama untuk Halaman Login -->
<section class="min-h-screen bg-[#76aeb8] flex items-center justify-center">
    <div class="container flex flex-col items-center justify-center px-6 py-8 mx-auto">
        <!-- Kontainer Card Login -->
        <div class="w-full bg-white/30 backdrop-blur-lg rounded-2xl shadow-md md:sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                <!-- Judul Login -->
                <h1 class="text-xl font-bold leading-tight tracking-tight text-black md:text-2xl">
                    Login
                </h1>

                <!-- Form Login -->
                <form class="space-y-4 md:space-y-6" action="#">
                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black" placeholder="@gmail.com" required="">
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-300 block w-full p-2.5 dark:text-black" required="">
                    </div>

                    <!-- Tombol Login -->
                    <button type="submit" class="w-full text-white bg-[#3399ab] hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mt-5">Login</button>

                    <!-- Tautan untuk Buat Akun Baru -->
                    <p class="text-sm font-light text-black mt-2">
                        Already have an account?
                        <a href="#" id="create-account-link" class="font-medium text-blue-500 hover:underline dark:text-blue-500">Create account</a>
                    </p>

                    <!-- Dropdown untuk Opsi Pembuatan Akun (Mahasiswa/Dosen) -->
                    <div id="account-options" class="hidden mt-2">
                        <ul>
                            <!-- Link Pendaftaran Akun Mahasiswa -->
                            <li><a href="{{ route('mahasiswa.register') }}" class="block p-2 text-blue-500 hover:underline">Create account for Mahasiswa</a></li>
                            <!-- Link Pendaftaran Akun Dosen -->
                            <li><a href="{{ route('dosen.register') }}" class="block p-2 text-blue-500 hover:underline">Create account for Dosen</a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


