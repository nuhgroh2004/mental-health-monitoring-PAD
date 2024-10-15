<!-- Stylesheets dan ikon -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
@vite('resources/css/app.css')
<!-- Navigasi -->
<nav class="bg-white bg-opacity-75 sticky top-0 z-50">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <!-- Menu sebelah kiri -->
            <div class="slider-3" id="slider-3"></div>
            <!-- Menu desktop (ditampilkan hanya pada layar besar) -->
            <div class="hidden sm:flex space-x-9 relative">
                <a href="{{ route('dosen.landingPage') }}" class="menu-item" data-menu="report">Lihat Report</a>
                <a href="{{ route('dosen.createUser') }}" class="menu-item" data-menu="create-user">Create User</a>
                <a href="{{ route('dosen.notifikasi') }}" class="menu-item" data-menu="Notifikasi">Notifikasi</a>
                <a href="{{ route('dosen.profil') }}" class="menu-item" data-menu="profil">profil</a>
            </div>
            <div class="flex items-center space-x-4">
                <img class="h-[50px] w-auto ml-3 mr-0 md:mr-[587px]" src="{{ asset('asset/logo.png') }}" alt="Logo">
            </div>
            <!-- Menu hamburger untuk layar kecil -->
            <div class="sm:hidden mr-3">
                <button type="button" class="text-gray-500 hover:text-gray-600" id="mobile-menu-button">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Menu dropdown untuk layar kecil -->
    <div class="hidden" id="mobile-menu">
        <div class="space-y-2 px-2 pt-2 pb-3">
            <a href="{{ route('dosen.landingPage') }}" class="menu-item block px-3 py-2 rounded-md text-base font-medium" data-menu="report">Lihat Report</a>
            <a href="{{ route('dosen.createUser') }}" class="menu-item block px-3 py-2 rounded-md text-base font-medium" data-menu="create-user">Create User</a>
            <a href="{{ route('dosen.notifikasi') }}" class="menu-item block px-3 py-2 rounded-md text-base font-medium" data-menu="notifikasi">Notifikasi</a>
            <a href="{{ route('dosen.profil') }}" class="menu-item block px-3 py-2 rounded-md text-base font-medium" data-menu="profil">profil</a>
        </div>
    </div>
</nav>
@yield('content')
<script src="{{ asset('JS/script.js') }}"></script>

