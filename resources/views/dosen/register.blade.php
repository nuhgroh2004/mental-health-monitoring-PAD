<head>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>GamaPulse</title>
    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">

    @vite('resources/css/app.css')
</head>
<title>Register</title>
<section class="min-h-screen bg-cover bg-[#F2FFFF]">
    <div class="flex flex-col items-center justify-center px-6 mx-auto">
        <div class="w-full bg-white backdrop-blur-lg rounded-2xl shadow-md md:sm:max-w-md mt-10 lg:mb-10">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-black md:text-2xl">
                    Create an account
                </h1>
                {{-- @dump(session()->all()) --}}
                <form class="space-y-4 md:space-y-6" action="{{ route('store.dosen') }}" method="post">
                    @csrf

                    {{-- Form name --}}
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">User Name</label>
                        <input type="text" name="name" id="name" placeholder="User name" required="" value="{{ old('name') }}"
                               class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Form email --}}
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Your email</label>
                        <input type="email" name="email" id="email" placeholder="@ugm.ac.id" required="" value="{{ old('email') }}"
                               class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Form password --}}
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" required="" value="{{ old('password') }}"
                               class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-300 block w-full p-2.5 dark:text-black">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Form captcha --}}
                    <div class="form-group mb-3">
                        <strong>Google reCAPTCHA:</strong>
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                        @error('g-recaptcha-response')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full text-white bg-[#3399ab] hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mt-5">
                        Create account
                    </button>
                    <p class="text-sm font-light text-black mt-2">
                        Already have an account? <a href="{{ route('login') }}" class="font-medium text-blue-500 hover:underline dark:text-blue-500">Login here</a>
                    </p>
                </form>

            </div>
        </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('JS/main.js') }}"></script>


