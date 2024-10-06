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
            <div class="hidden sm:flex space-x-4 relative">
                <a href="{{ route('mahasiswa.landingPage') }}" class="menu-item" data-menu="report">Home</a>
                <a href="{{ route('mahasiswa.viewMoodCalendar') }}" class="menu-item" data-menu="view-mood">View Mood</a>
                <a href="{{ route('mahasiswa.report') }}" class="menu-item" data-menu="Report">Report</a>
                <a href="{{ route('mahasiswa.notifikasi') }}" class="menu-item" data-menu="Notifikasi">Notifikasi</a>
                <a href="#"  onclick="showLogoutAlert()">Logout</a>
            </div>

            <!-- Menu hamburger untuk layar kecil -->
            <div class="sm:hidden">
                <button type="button" class="text-gray-500 hover:text-gray-600" id="mobile-menu-button">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Logo di tengah -->
            <div class="aller-dasbor-dosen flex flex-1 sm:items-stretch sm:justify-center ml-10">
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('landingPage') }}">
                        <img class="h-12 w-auto mr-[360px]" src="{{ asset('asset/logo.png') }}" alt="Your Company">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu dropdown untuk layar kecil -->
    <div class="sm:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="#" class="menu-item block px-3 py-2 rounded-md text-base font-medium" data-menu="Home">Home</a>
            <a href="#" class="menu-item block px-3 py-2 rounded-md text-base font-medium" data-menu="view-mood">View Mood</a>
            <a href="#" class="menu-item block px-3 py-2 rounded-md text-base font-medium" data-menu="report">Report</a>
            <a href="#" class="menu-item block px-3 py-2 rounded-md text-base font-medium" data-menu="notifikasi">Notifikasi</a>
            <a class="menu-item block"  onclick="showLogoutAlert()">Logout</a>
        </div>
    </div>
</nav>
<div id="logoutModal" class="aller-dasbor-dosen fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full text-center">
      <h2 class="text-lg font-semibold mb-4">Apakah Anda yakin ingin log out?</h2>
      <div class="flex space-x-4 justify-center">
        <button id="confirmLogout" class="bg-red-500 text-white py-2 px-4 rounded-lg w-full">Ya</button>
        <button id="cancelLogout" class="bg-gray-500 text-white py-2 px-4 rounded-lg w-full">Tidak</button>
      </div>
    </div>
</div>

<!-- Memuat konten tambahan dari halaman lain -->
<script src="{{ asset('JS/script.js') }}"></script>
@yield('content')



