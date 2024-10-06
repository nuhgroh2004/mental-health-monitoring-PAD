@extends('navbar/navbar1')
@section('content')
<title>Register</title>
<section class="bg-[#76aeb8]" >
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 mt-20 mb-20">
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
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black" placeholder="@gmail.com" required="">
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-300 block w-full p-2.5 dark:text-black" required="">
                    </div>
                    <div>
                        <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 mt-2">NIMM</label>
                        <input type="text" name="nim" id="nim" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black" placeholder="NIM" required="">
                    <div>
                         <!-- Tampilkan CAPTCHA -->
                         <div>
                            <label for="captcha" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Captcha</label>
                            <div class="captcha mb-4">
                                {{-- <span>{!! captcha_img('flat') !!}</span> --}}
                                <button type="button" class="btn btn-warning" id="refresh-captcha">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16">
                                        <path d="M500.33 7.03c-7.96-8.27-20.71-8.68-29.04-.87l-99.68 93.16C319.45 36.28 269.85 16 216 16 98.11 16 0 114.11 0 232s98.11 216 216 216c73.56 0 139.03-36.42 178.78-92.56 6.25-8.79 4.06-20.94-4.72-27.19-8.79-6.25-20.94-4.06-27.19 4.72C328.68 391.3 274.48 424 216 424c-104.77 0-190-85.23-190-190s85.23-190 190-190c47.71 0 91.3 17.54 125.38 47.55l-85.9 80.34c-8.33 7.8-8.74 20.55-.87 29.04 7.8 8.33 20.55 8.74 29.04.87l120-112c4.17-3.89 6.56-9.37 6.56-15.04s-2.39-11.15-6.56-15.04l-120-112z" />
                                    </svg>
                                </button>
                            </div>
                            <input type="text" name="captcha" id="captcha" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black" placeholder="Enter Captcha" required>

                            <!-- Tempatkan error handling CAPTCHA di sini -->
                            @if ($errors->has('captcha'))
                                <div class="text-red-500 text-sm mt-2">
                                    {{ $errors->first('captcha') }}
                                </div>
                            @endif
                        </div>

                    <button type="submit" class="w-full text-white bg-[#3399ab] hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mt-5">Create account</button>
                    <p class="text-sm font-light text-black mt-2">
                        Already have an account? <a href="{{ route('login') }}" class="font-medium text-blue-500 hover:underline dark:text-blue-500">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
  </section>
@endsection
