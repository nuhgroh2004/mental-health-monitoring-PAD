<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Register Mahasiswa</title>
    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
    @vite('resources/css/app.css')
</head>
<title>Register</title>
<section class="min-h-screen bg-cover bg-[#F2FFFF]">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0 ">
        <div class="w-full bg-white backdrop-blur-lg rounded-2xl shadow-md md:sm:max-w-md xl:p-0 mt-5 mb-5">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-black md:text-2xl">
                    Create a student account
                </h1>
                {{-- @dump(session()->all()) --}}
                <form class="space-y-4 md:space-y-6" action="{{route ('store.mahasiswa')}}" method="POST">
                    @csrf
                    {{-- Form name --}}
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">UserName</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black"
                        placeholder="Username" value="{{ old('name') }}" required="">
                        @if ($errors->has('name'))
                            <div class="text-red-500 text-sm mt-2">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    <div>

                    {{-- Form email --}}
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black"
                        placeholder="@mail.ugm.ac.id" value="{{ old('email') }}" required="">
                        @if ($errors->has('email'))
                            <div class="text-red-500 text-sm mt-2">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    <div>

                    {{-- Form prodi --}}
                    <div>
                        <label for="prodi" class="block mb-2 text-sm font-medium text-gray-900">Prodi</label>
                        <input type="text" name="prodi" id="prodi" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black"
                        placeholder="Prodi" value="{{ old('prodi') }}" required="">
                        @if ($errors->has('prodi'))
                            <div class="text-red-500 text-sm mt-2">
                                {{ $errors->first('prodi') }}
                            </div>
                        @endif
                    <div>

                    {{-- Form TTL --}}
                    <div>
                        <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black"
                        placeholder="@mail.ugm.ac.id" value="{{ old('tanggal_lahir') }}" required="">
                        @if ($errors->has('tanggal_lahir'))
                            <div class="text-red-500 text-sm mt-2">
                                {{ $errors->first('tanggal_lahir') }}
                            </div>
                        @endif
                    <div>

                    {{-- Form phone number --}}
                    <div>
                        <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Phone Number</label>
                        <input type="number" name="phone_number" id="phone_number" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black"
                        placeholder="Phone Number" value="{{ old('phone_number') }}" required="">
                    </div>
                    @if ($errors->has('phone_number'))
                        <div class="text-red-500 text-sm mt-2">
                            {{ $errors->first('phone_number') }}
                        </div>
                    @endif

                    {{-- Form password --}}
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-300 block w-full p-2.5 dark:text-black"
                        required="">
                        @if ($errors->has('password'))
                            <div class="text-red-500 text-sm mt-2">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    {{-- Form NIM --}}
                    <div>
                        <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 mt-2">NIM</label>
                        <input type="text" name="nim" id="nim" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black"
                        placeholder="NIM" value="{{ old('nim') }}" required="">
                        @if ($errors->has('nim'))
                            <div class="text-red-500 text-sm mt-2">
                                {{ $errors->first('nim') }}
                            </div>
                        @endif
                    <div>

                    {{-- Bagian Captcha --}}
                    <div class="form-group mb-3">
                        <strong>Google recaptcha :</strong>
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                    </div>

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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('JS/main.js') }}"></script>
