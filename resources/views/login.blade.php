<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login</title>

    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite('resources/css/app.css')
</head>
<title>Login</title>

<!-- Section Utama untuk Halaman Login -->
<section class="min-h-screen bg-cover bg-[#F2FFFF]">
    <div class="container flex flex-col items-center justify-center px-6 py-8 mx-auto">
        <!-- Kontainer Card Login -->
        <div class="w-full bg-white backdrop-blur-lg rounded-2xl shadow-md md:sm:max-w-md xl:p-0 lg:mt-10 mt-[100px]">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                <!-- Judul Login -->
                <h1 class="text-xl font-bold leading-tight tracking-tight text-black md:text-2xl">
                    Login
                </h1>

                <!-- Form Login -->
                <form class="space-y-4 md:space-y-6" action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-gray-300 dark:text-black" placeholder="@gmail.com" required="">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>


                    <!-- Input Password -->
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 mt-2">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-300 block w-full p-2.5 dark:text-black" required="">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('JS/main.js') }}"></script>


