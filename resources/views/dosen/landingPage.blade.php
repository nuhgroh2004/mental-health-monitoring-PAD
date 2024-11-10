
@extends('navbar/navbar-dosen')
@section('content')
<title>Admin Panel</title>


<!-- Main container -->
<div class="max-w-4xl mx-auto p-6 bg-white mt-[100px]">
    <!-- Search form -->
    <form class="mb-6" id="searchForm">
        <div class="flex">
            <!-- Dropdown for selecting search type -->
            <select id="search-type" class="flex-shrink-0 inline-flex items-center px-4 text-sm font-medium text-black bg-white border border-gray-300 rounded-s-lg focus:outline-none focus:ring-gray-100 dark:bg-white dark:text-black dark:border-gray-300 text-center">
                <option value="nama" class="text-center">Nama</option>
                <option value="nim" class="text-center">NIM</option>
            </select>
            <!-- Search input and button -->
            <div class="relative w-full">
                <input type="search" id="search-input" class="block p-2.5 w-full z-20 text-sm text-black bg-white rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 placeholder-gray-400 focus:outline-none focus:border-blue-500 dark:bg-white dark:border-gray-300 dark:placeholder-gray-400" placeholder="Cari Nama atau NIM..." required autocomplete="off" />
                <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-500 rounded-e-lg border border-blue-400 focus:ring-4">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>
    </form>

    <!-- Search Results -->
    <div id="searchResults" class="bg-white shadow-md rounded-lg overflow-hidden hidden transition-all duration-300 ease-in-out">
        <div class="p-4 border-b bg-[#64cfe2]">
            <h3 class="text-lg font-semibold text-white">Hasil Pencarian</h3>
        </div>
        <ul class="divide-y divide-gray-200">
            <li class="p-4 hover:bg-gray-50">
                <div class="lg:flex lg:justify-between lg:items-center">
                    <div class="mb-4 lg:mb-0">
                        <p class="font-medium text-gray-800 mb-2">
                            <span class="inline-block w-16">Nama</span>
                            <span class="font-medium text-gray-800">:</span>
                            <span class="ml-2" id="resultName">Mamang jon</span>
                        </p>
                        <p class="font-medium text-gray-800">
                            <span class="inline-block w-16">NIM</span>
                            <span class="font-medium text-gray-800">:</span>
                            <span class="ml-2" id="resultNIM">123456789</span>
                        </p>
                    </div>
                    <div class="flex space-x-3 lg:w-auto w-fit ml-auto">
                        <button class="flex-none bg-blue-600 text-white hover:bg-blue-700 rounded-lg lg:px-4 lg:py-2 px-2 py-1 text-sm lg:text-base w-20 lg:w-auto" title="Minta Izin" onclick="handlePermissionRequest()">
                            Kirim izin
                        </button>
                        <button class="flex-none bg-red-600 text-white hover:bg-red-700 rounded-lg lg:px-4 lg:py-2 px-2 py-1 text-sm lg:text-base w-20 lg:w-auto" title="Hapus" onclick="handleDelete()">
                            Hapus
                        </button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
