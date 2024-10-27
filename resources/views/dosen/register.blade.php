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
<title>Register</title>
<section class="bg-[#76aeb8]" >
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 mt-7 mb-10">
        <div class="w-full bg-white/30 backdrop-blur-lg rounded-2xl shadow-md md:sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-black md:text-2xl">
                    Create an account
                </h1>
                <form class="space-y-4 md:space-y-6" action="#">
                    @csrf
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">User Name</label>
                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black" placeholder="User name" required="">
                    <div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black" placeholder="@ugm.ac.id" required="">
                        <div id="emailError" class="text-red-500 text-sm mt-2 hidden">Gunakan email UGM anda</div>
                    </div>

                    {{-- untuk memberitahu agar menggunakan email ugm --}}
                    <script>
                        document.getElementById('email').addEventListener('input', function() {
                            const email = this.value;
                            const emailError = document.getElementById('emailError');
                            if (!email.endsWith('@ugm.ac.id')) {
                                emailError.classList.remove('hidden');
                            } else {
                                emailError.classList.add('hidden');
                            }
                        });
                    </script>
                      {{-- untuk memberitahu agar menggunakan email ugm --}}

                      <div class="relative">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-300 block w-full p-2.5 dark:text-black" required="">

                        <!-- Tombol untuk toggle visibility -->
                        <button type="button" id="togglePassword" class="absolute right-3 top-[39px] text-gray-400">
                            <!-- Icon Mata Tertutup (Hide Password), tampilkan di awal -->
                            <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <!-- Icon Mata Terbuka (Show Password), disembunyikan di awal -->
                            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59" />
                            </svg>
                        </button>
                    </div>
                    </div>
                    <div>
                        <label for="captcha" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Captcha</label>
                        <div id="captchaTable" class="flex justify-center items-center space-x-4 mb-4"></div> <!-- Tempat CAPTCHA ditampilkan -->
                        <div class="flex items-center">
                            <input type="text" name="captcha" id="captchaInput" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black" placeholder="Enter Captcha" required>
                            <!-- Tombol untuk refresh CAPTCHA -->
                            <button id="refreshButton" type="button" class="ml-2 bg-[#3399ab] text-white px-3 py-2 rounded-md focus:outline-none">
                                <svg id="refreshIcon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 20C9.76667 20 7.875 19.225 6.325 17.675C4.775 16.125 4 14.2333 4 12C4 9.76667 4.775 7.875 6.325 6.325C7.875 4.775 9.76667 4 12 4C13.15 4 14.25 4.23733 15.3 4.712C16.35 5.18667 17.25 5.866 18 6.75V4H20V11H13V9H17.2C16.6667 8.06667 15.9377 7.33333 15.013 6.8C14.0883 6.26667 13.084 6 12 6C10.3333 6 8.91667 6.58333 7.75 7.75C6.58333 8.91667 6 10.3333 6 12C6 13.6667 6.58333 15.0833 7.75 16.25C8.91667 17.4167 10.3333 18 12 18C13.2833 18 14.4417 17.6333 15.475 16.9C16.5083 16.1667 17.2333 15.2 17.65 14H19.75C19.2833 15.7667 18.3333 17.2083 16.9 18.325C15.4667 19.4417 13.8333 20 12 20Z" fill="white"/>
                                </svg>

                            </button>
                        </div>


                        <!-- Tempatkan error handling CAPTCHA di sini -->
                        @if ($errors->has('captcha'))
                            <div class="text-red-500 text-sm mt-2">
                                {{ $errors->first('captcha') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit" formaction="{{ route('dosen.otp') }}" class="w-full text-white bg-[#3399ab] hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mt-5">Create account</button>
                    <p class="text-sm font-light text-black mt-2">
                        Already have an account? <a href="{{ route('login') }}" class="font-medium text-blue-500 hover:underline dark:text-blue-500">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
  </section>
@endsection


