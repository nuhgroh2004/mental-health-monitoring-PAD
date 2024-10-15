@extends('navbar/navbar2')
@section('content')
<title>Admin Panel</title>

<!-- Main container -->
<div class="max-w-4xl mx-auto p-6 bg-[#76aeb8]">
    <!-- Search form -->
    <form class="mb-6" id="searchForm">
        <div class="flex">
            <!-- Dropdown for selecting search type -->
            <select id="search-type" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-black bg-white border border-gray-300 rounded-s-lg focus:outline-none focus:ring-gray-100 dark:bg-white dark:text-black dark:border-gray-300">
                <option value="nama">Nama</option>
                <option value="nim">NIM</option>
            </select>
            <!-- Search input and button -->
            <div class="relative w-full">
                <input type="search" id="search-input" class="block p-2.5 w-full z-20 text-sm text-black bg-white rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 placeholder-gray-400 focus:outline-none focus:border-blue-500 dark:bg-white dark:border-gray-300 dark:placeholder-gray-400" placeholder="Cari Nama atau NIM..." required />
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
        <div class="p-4 border-b bg-[#57a5b3] text-white">
            <h3 class="text-lg font-semibold">Hasil Pencarian</h3>
        </div>
        <ul class="divide-y divide-gray-200">
            <li class="p-4 hover:bg-gray-50 flex justify-between items-center">
                <div>
                    <!-- Name and NIM display with improved styling -->
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
                <div class="flex space-x-4">
                    <!-- Paper plane icon for "Minta Izin" -->
                    <button class="text-blue-600 hover:text-blue-800" title="Minta Izin" onclick="openRequestPermissionModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                    <!-- Delete icon -->
                    <button class="text-red-600 hover:text-red-800" title="Hapus" onclick="openDeleteModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="aller-dasbor-dosen fixed inset-0 hidden bg-gray-900 bg-opacity-75 items-center justify-center z-50">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center transform transition-all duration-300 ease-in-out max-w-md w-full">
        <h3 class="text-xl font-semibold text-gray-800">Apakah Anda yakin ingin menghapus?</h3>
        <div class="mt-6 flex justify-center space-x-4">
            <!-- Tombol "Iya" dan "Tidak" memiliki ukuran yang sama -->
            <button onclick="confirmDelete()" class="flex-1 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-300">
                Iya
            </button>
            <button onclick="closeDeleteModal()" class="flex-1 bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-300">
                Tidak
            </button>
        </div>
    </div>
</div>


<!-- Request Permission Modal -->
<div id="requestPermissionModal" class="aller-dasbor-dosen fixed inset-0 hidden bg-gray-900 bg-opacity-75 items-center justify-center z-50">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center transform transition-all duration-300 ease-in-out max-w-md w-full">
        <h3 class="text-xl font-semibold text-gray-800">Apakah Anda ingin meminta izin?</h3>
        <div class="mt-6 flex justify-center space-x-4">
            <!-- Tombol "Iya" dan "Tidak" memiliki ukuran yang sama besar -->
            <button onclick="confirmRequestPermission()" class="flex-1 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                Iya
            </button>
            <button onclick="closeRequestPermissionModal()" class="flex-1 bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-300">
                Tidak
            </button>
        </div>
    </div>
</div>


<!-- Alert for delete success -->
<div id="deleteAlert" class="fixed top-20 left-1/2 transform -translate-x-1/2 bg-red-500 text-white text-lg font-bold py-2 px-4 rounded shadow-lg hidden"
     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-full"
     x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-full">
    Delete sukses!
</div>

<!-- Alert for permission request success -->
<div id="requestPermissionAlert" class="fixed top-20 left-1/2 transform -translate-x-1/2 bg-blue-500 text-white text-lg font-bold py-2 px-4 rounded shadow-lg hidden"
     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-full"
     x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-full">
    Permission request sent successfully!
</div>
@endsection
