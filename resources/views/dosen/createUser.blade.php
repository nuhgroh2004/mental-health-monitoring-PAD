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
                            <svg width="24" height="24 " class="absolute left-3 top-2 h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 17C11.4696 17 10.9609 16.7893 10.5858 16.4142C10.2107 16.0391 10 15.5304 10 15C10 13.89 10.89 13 12 13C12.5304 13 13.0391 13.2107 13.4142 13.5858C13.7893 13.9609 14 14.4696 14 15C14 15.5304 13.7893 16.0391 13.4142 16.4142C13.0391 16.7893 12.5304 17 12 17ZM18 20V10H6V20H18ZM18 8C18.5304 8 19.0391 8.21071 19.4142 8.58579C19.7893 8.96086 20 9.46957 20 10V20C20 20.5304 19.7893 21.0391 19.4142 21.4142C19.0391 21.7893 18.5304 22 18 22H6C5.46957 22 4.96086 21.7893 4.58579 21.4142C4.21071 21.0391 4 20.5304 4 20V10C4 8.89 4.89 8 6 8H7V6C7 4.67392 7.52678 3.40215 8.46447 2.46447C9.40215 1.52678 10.6739 1 12 1C12.6566 1 13.3068 1.12933 13.9134 1.3806C14.52 1.63188 15.0712 2.00017 15.5355 2.46447C15.9998 2.92876 16.3681 3.47995 16.6194 4.08658C16.8707 4.69321 17 5.34339 17 6V8H18ZM12 3C11.2044 3 10.4413 3.31607 9.87868 3.87868C9.31607 4.44129 9 5.20435 9 6V8H15V6C15 5.20435 14.6839 4.44129 14.1213 3.87868C13.5587 3.31607 12.7956 3 12 3Z" fill="#9CA3AF"/>
                            </svg>

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
                                <svg width="16" height="16" class="absolute left-3 top-2 h-5 w-5 text-gray-400" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 2C7.46957 2 6.96086 2.21071 6.58579 2.58579C6.21071 2.96086 6 3.46957 6 4C6 4.53043 6.21071 5.03914 6.58579 5.41421C6.96086 5.78929 7.46957 6 8 6C8.53043 6 9.03914 5.78929 9.41421 5.41421C9.78929 5.03914 10 4.53043 10 4C10 3.46957 9.78929 2.96086 9.41421 2.58579C9.03914 2.21071 8.53043 2 8 2ZM8 9C10.67 9 16 10.33 16 13V16H0V13C0 10.33 5.33 9 8 9ZM8 10.9C5.03 10.9 1.9 12.36 1.9 13V14.1H14.1V13C14.1 12.36 10.97 10.9 8 10.9Z" fill="#9CA3AF"/>
                                </svg>


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
                                <svg width="24" height="24" class="absolute left-3 top-2 h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.3686 3.8874L12.2918 0.0492474C12.1023 -0.0164158 11.8975 -0.0164158 11.708 0.0492474L0.631148 3.8874C0.447348 3.95109 0.287487 4.07328 0.17421 4.23667C0.0609337 4.40006 -1.43563e-05 4.59636 2.53655e-09 4.79776V14.3931C2.53655e-09 14.6476 0.0972516 14.8917 0.270361 15.0716C0.44347 15.2516 0.678256 15.3527 0.923069 15.3527C1.16788 15.3527 1.40267 15.2516 1.57578 15.0716C1.74889 14.8917 1.84614 14.6476 1.84614 14.3931V6.12911L5.72187 7.47127C4.69214 9.2006 4.36469 11.284 4.81142 13.2641C5.25815 15.2442 6.44255 16.9591 8.10455 18.0322C6.02764 18.879 4.23227 20.4106 2.91921 22.5048C2.85092 22.6103 2.80348 22.7289 2.77966 22.8536C2.75584 22.9783 2.75611 23.1068 2.78045 23.2314C2.80479 23.356 2.85271 23.4743 2.92144 23.5795C2.99016 23.6847 3.07832 23.7747 3.18078 23.8442C3.28325 23.9136 3.39797 23.9612 3.51829 23.9842C3.6386 24.0072 3.76211 24.0051 3.88164 23.978C4.00116 23.9509 4.11432 23.8994 4.21452 23.8265C4.31473 23.7535 4.39999 23.6606 4.46535 23.5531C6.20418 20.78 8.95031 19.1908 11.9999 19.1908C15.0495 19.1908 17.7956 20.78 19.5344 23.5531C19.6698 23.7623 19.879 23.9077 20.1166 23.9578C20.3543 24.008 20.6014 23.9589 20.8046 23.8212C21.0077 23.6834 21.1505 23.4681 21.2022 23.2218C21.2538 22.9755 21.2102 22.7179 21.0806 22.5048C19.7675 20.4106 17.9652 18.879 15.8952 18.0322C17.5557 16.9591 18.7389 15.2454 19.1856 13.2667C19.6322 11.2881 19.3058 9.20609 18.2779 7.47726L23.3686 5.71411C23.5525 5.65046 23.7124 5.52828 23.8257 5.36489C23.939 5.2015 24 5.00518 24 4.80375C24 4.60233 23.939 4.40601 23.8257 4.24262C23.7124 4.07923 23.5525 3.95705 23.3686 3.89339V3.8874ZM17.5383 11.5145C17.5386 12.4247 17.3312 13.322 16.9333 14.1327C16.5353 14.9435 15.9581 15.6446 15.249 16.1786C14.5399 16.7125 13.7192 17.0641 12.854 17.2045C11.9889 17.3449 11.1041 17.27 10.2722 16.9861C9.4403 16.7022 8.68501 16.2172 8.0683 15.5711C7.4516 14.925 6.99105 14.1361 6.72445 13.2691C6.45785 12.4021 6.39279 11.4818 6.53462 10.5836C6.67644 9.68547 7.0211 8.83505 7.54032 8.10216L11.708 9.54147C11.8975 9.60713 12.1023 9.60713 12.2918 9.54147L16.4595 8.10216C17.1607 9.09052 17.5388 10.2864 17.5383 11.5145ZM11.9999 7.62479L3.84227 4.79776L11.9999 1.97072L20.1575 4.79776L11.9999 7.62479Z" fill="#9CA3AF"/>
                                </svg>

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
