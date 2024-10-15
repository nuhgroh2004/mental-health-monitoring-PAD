@extends('navbar/navbar2') <!-- Meng-extend layout navbar -->
@section('content') <!-- Menentukan bagian konten yang akan diisi -->

<title>Create User</title>
<body class="bg-gray-100">
    <!-- Menambahkan container untuk form dengan Alpine.js untuk data binding -->
    <div class="container mx-auto p-4" x-data="createUserForm()">
        <!-- Judul form -->
        <h1 class="text-3xl font-bold mb-6 text-center">Create User</h1>

        <!-- Form utama untuk menambahkan user -->
        <form @submit.prevent="submitForm" class="space-y-6">
            <!-- Loop form untuk setiap user menggunakan x-for -->
            <template x-for="(user, index) in users" :key="index">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 transition-all duration-500 ease-in-out"
                     x-transition:enter="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100">
                    <!-- Input email -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'email-' + index">
                            Email
                        </label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pl-10"
                                :id="'email-' + index"
                                type="email"
                                placeholder="Email"
                                x-model="user.email"
                                required>
                            <!-- Icon email di sebelah kiri input -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-2 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Input password dengan tombol untuk melihat password -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'password-' + index">
                            Password
                        </label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pl-10 pr-10"
                                :id="'password-' + index"
                                :type="user.showPassword ? 'text' : 'password'"
                                placeholder="Password"
                                x-model="user.password"
                                required>
                            <!-- Tombol untuk menampilkan/menyembunyikan password -->
                            <button type="button" class="absolute right-3 top-2 text-gray-400" @click="user.showPassword = !user.showPassword">
                                <svg x-show="!user.showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="user.showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Input name -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'name-' + index">Name</label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pl-10"
                                :id="'name-' + index"
                                type="text"
                                placeholder="Name"
                                x-model="user.name"
                                required>
                        </div>
                    </div>

                    <!-- Input NIM -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'nim-' + index">NIM</label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pl-10"
                                :id="'nim-' + index"
                                type="text"
                                placeholder="NIM"
                                x-model="user.nim"
                                required>
                        </div>
                    </div>

                    <!-- Tombol untuk menghapus user -->
                    <button type="button" @click="removeUser(index)" class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-transform duration-300 ease-in-out transform hover:scale-105">
                        Remove
                    </button>
                </div>
            </template>

            <!-- Tombol untuk menambahkan user baru -->
            <div class="flex justify-between items-center">
                <button type="button" @click="addUser" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline flex items-center transition-transform duration-300 ease-in-out transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add User
                </button>

                <!-- Tombol untuk menyimpan data user -->
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-transform duration-300 ease-in-out transform hover:scale-105">
                    Create Users
                </button>
            </div>
        </form>

        <!-- Bagian yang menampilkan user yang sudah dibuat -->
        <div x-show="showCreatedUsers" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Created Users</h2>
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <template x-for="(user, index) in createdUsers" :key="index">
                    <div class="mb-4 p-4 border-b">
                        <p><strong>No:</strong> <span x-text="index + 1"></span></p>
                        <p><strong>Email:</strong> <span x-text="user.email"></span></p>
                        <p><strong>Password:</strong> <span x-text="user.password"></span></p>
                        <p><strong>Name:</strong> <span x-text="user.name"></span></p>
                        <p><strong>NIM:</strong> <span x-text="user.nim"></span></p>
                    </div>
                </template>
            </div>

            <!-- Tombol untuk mengunduh data user dalam bentuk Excel -->
            <button @click="downloadExcel" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-transform duration-300 ease-in-out transform hover:scale-105">
                Download as Excel
            </button>
        </div>

        <!-- Bagian untuk mengimpor user dari file Excel -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Import Users from Excel</h2>
            <div class="flex justify-between items-center mb-4">
                <!-- Tombol untuk mengunduh template Excel -->
                <button @click="downloadTemplate" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-transform duration-300 ease-in-out transform hover:scale-105">
                    Download Template
                </button>
            </div>

            <!-- Area drag-and-drop untuk mengunggah file Excel -->
            <div x-data="{ dragOver: false }" @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false" @drop.prevent="handleDrop($event); dragOver = false" :class="{ 'bg-blue-100 border-blue-300': dragOver }" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center transition-colors duration-300">
                <p class="text-gray-600 mb-2">Drag and drop your Excel file here, or click to select</p>
                <label class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer inline-block transition-transform duration-300 ease-in-out transform hover:scale-105">
                    <span>Select Excel File</span>
                    <input type="file" class="hidden" accept=".xlsx, .xls" @change="handleFileSelect">
                </label>
            </div>

            <!-- Tombol untuk membuat user dari file Excel -->
            <button @click="submitExcel" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-transform duration-300 ease-in-out transform hover:scale-105 mb-8">
                Create from Excel
            </button>
        </div>

        <!-- Notifikasi kesuksesan impor Excel -->
        <div x-show="excelCreationSuccess" class="fixed top-20 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-lg font-bold py-2 px-4 rounded shadow-lg"
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-full"
             x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-full">
            Excel users created successfully!
        </div>
    </div>

    <!-- Script untuk fungsi reaktivitas dan penanganan Excel menggunakan Alpine.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</body>
@endsection
