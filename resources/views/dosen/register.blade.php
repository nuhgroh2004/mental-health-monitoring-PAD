@extends('navbar/navbar1')

@section('content')
<title>Register</title>
<section class="bg-[#76aeb8]">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 mt-7 mb-10">
        <div class="w-full bg-white/30 backdrop-blur-lg rounded-2xl shadow-md md:sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-black md:text-2xl">
                    Create a lecturer account
                </h1>
                @dump(session()->all())
                <form class="space-y-4 md:space-y-6" action="{{ route('store.dosen') }}" method="POST">
                    @csrf

                    {{-- Form name --}}
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">User Name</label>
                        <input type="text" name="name" id="name" placeholder="User name" required="" value="{{ old('name') }}"
                               class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black">
                    </div>

                    {{-- Form email --}}
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Your email</label>
                        <input type="email" name="email" id="email" placeholder="@ugm.ac.id" required="" value="{{ old('email') }}"
                               class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black">
                    </div>

                    {{-- Form password --}}
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" required=""
                               class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-300 block w-full p-2.5 dark:text-black">
                    </div>

                    {{-- Form captcha --}}
                    <div class="form-group mb-3">
                        <strong>Google reCAPTCHA:</strong>
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                    </div>

                    @if ($errors->has('captcha'))
                        <div class="text-red-500 text-sm mt-2">
                            {{ $errors->first('captcha') }}
                        </div>
                    @endif

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
