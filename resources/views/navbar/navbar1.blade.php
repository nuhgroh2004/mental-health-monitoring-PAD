
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@vite('resources/css/app.css')
<link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
<nav class="bg-white bg-opacity-75 sticky top-0 z-50">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="flex flex-1 sm:items-stretch sm:justify-start">
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('landingPage') }}">
                        <img class="h-12 w-auto" src="{{ asset('asset/logo.png') }}" alt="Your Company">
                    </a>
                    <a href="{{ route('landingPage') }}">
                        <span class="ml-2 text-lg font-bold text-gray-900">GamaPlus</span>
                    </a>
                </div>
                <div class="btn-toggle-container">
                    <div class="btn-toggle relative">
                        <div class="slider" id="slider"></div>
                        <a href="{{ route('login') }}" id="loginBtn" class="text-sm ml-1">Login</a>
                        <a id="registerBtn" class="text-sm" href="javascript:void(0);" onclick="toggleDropdown()">Register</a>
                    </div>
                    <!-- Dropdown Menu -->
                    <div id="dropdownMenu" class="dropdown-menu">
                        <a href="{{ route('mahasiswa.register') }}" class="dropdown-item">Mahasiswa</a>
                        <a href="{{ route('dosen.register') }}" class="dropdown-item">Dosen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sm:hidden" id="mobile-menu"></div>
</nav>


@yield('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('JS/main.js') }}"></script>

