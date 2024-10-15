@extends('navbar/navbar1')
@section('content')
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
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-300 block w-full p-2.5 dark:text-black" required="">
                    </div>


                    <div>
                        <label for="captcha" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Captcha</label>
                        <div id="captchaTable" class="flex justify-center items-center space-x-4 mb-4"></div> <!-- Tempat CAPTCHA ditampilkan -->
                        <div class="flex items-center">
                            <input type="text" name="captcha" id="captchaInput" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black" placeholder="Enter Captcha" required>
                            <!-- Tombol untuk refresh CAPTCHA -->
                            <button id="refreshButton" type="button" class="ml-2 bg-[#3399ab] text-white px-3 py-2 rounded-md focus:outline-none">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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


