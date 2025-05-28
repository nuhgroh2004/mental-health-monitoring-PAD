@extends('navbar/navbar-dosen')
@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<title>Create User</title>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 mt-[100px]" x-data="createUserForm()">
        <h1 class="text-3xl font-bold mb-6 text-center">Tambah User</h1>

        <script>
            console.log('Roles from server:', @json($roles));
        </script>

        <form x-ref="userForm" @submit.prevent="submitForm" class="space-y-6">
            <template x-for="(user, index) in users" :key="index">
                <!-- Single root element untuk setiap user form -->
                <div class="bg-white shadow-lg rounded px-8 pt-6 pb-8 mb-4 transition-all duration-500 ease-in-out"
                     x-transition:enter="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100">

                    <!-- Email Field -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'email-' + index">Email</label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pl-10"
                                :id="'email-' + index"
                                type="email"
                                placeholder="Email"
                                x-model="user.email"
                                required>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'password-' + index">Password</label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pl-10 pr-10"
                                :id="'password-' + index"
                                :type="user.showPassword ? 'text' : 'password'"
                                placeholder="Password"
                                x-model="user.password"
                                required>
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

                    <!-- Name Field -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'name-' + index">Nama</label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pl-10"
                                :id="'name-' + index"
                                type="text"
                                placeholder="Nama"
                                x-model="user.name"
                                required>
                        </div>
                    </div>

                    <!-- NIM Field -->
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

                    <!-- Prodi Field -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'prodi-' + index">Program Studi</label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pl-10"
                                :id="'prodi-' + index"
                                type="text"
                                placeholder="Program Studi"
                                x-model="user.prodi">
                        </div>
                    </div>

                    <!-- Tanggal Lahir Field -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'tanggal_lahir-' + index">Tanggal Lahir</label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pl-10"
                                :id="'tanggal_lahir-' + index"
                                type="date"
                                x-model="user.tanggal_lahir">
                        </div>
                    </div>

                    <!-- Phone Field -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'phone-' + index">Nomor HP</label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pl-10"
                                :id="'phone-' + index"
                                type="tel"
                                placeholder="Nomor HP"
                                x-model="user.phone">
                        </div>
                    </div>

                    <!-- Role Field - Diperbaiki dengan x-model yang benar -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" :for="'role-' + index">Role</label>
                        <div class="relative">
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pl-10"
                                :id="'role-' + index"
                                x-model.number="user.role"
                                @change="console.log('Role selected:', user.role)"
                                required>
                                <option value="" selected disabled>Pilih Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="button" @click="removeUser(index)" class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-transform duration-300 ease-in-out transform hover:scale-105">
                        Hapus Form
                    </button>
                </div>
            </template>

            <div class="flex justify-between items-center">
                <button type="button" @click="addUser" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline flex items-center transition-transform duration-300 ease-in-out transform hover:scale-105">
                    Tambah Form
                </button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-transform duration-300 ease-in-out transform hover:scale-105">
                    Tambah User
                </button>
            </div>
        </form>

        <!-- Success Section -->
        <div x-show="showCreatedUsers" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" class="mt-8">
            <h2 class="text-2xl font-bold mb-4">User berhasil di tambahkan</h2>
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <template x-for="(user, index) in createdUsers" :key="index">
                    <div class="mb-4 p-4 border-b">
                        <p><strong>No:</strong> <span x-text="index + 1"></span></p>
                        <p><strong>Email:</strong> <span x-text="user.email"></span></p>
                        <p><strong>Password:</strong> <span x-text="user.password"></span></p>
                        <p><strong>Nama:</strong> <span x-text="user.name"></span></p>
                        <p><strong>NIM:</strong> <span x-text="user.nim"></span></p>
                        <p><strong>Program Studi:</strong> <span x-text="user.prodi || '-'"></span></p>
                        <p><strong>Tanggal Lahir:</strong> <span x-text="user.tanggal_lahir || '-'"></span></p>
                        <p><strong>Nomor HP:</strong> <span x-text="user.phone || '-'"></span></p>
                        <p><strong>Role:</strong> <span x-text="user.role_name || '-'"></span></p>
                    </div>
                </template>
            </div>

            <button @click="downloadExcel" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-transform duration-300 ease-in-out transform hover:scale-105">
                Download sebagai Excel
            </button>
        </div>

        <!-- Excel Import Section -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Import User-User dari Excel</h2>
            <div class="flex justify-between items-center mb-4">
                <button @click="downloadTemplate" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-transform duration-300 ease-in-out transform hover:scale-105">
                    Download Template
                </button>
            </div>

            <div
             @dragover.prevent="dragOver = true"
             @dragleave.prevent="dragOver = false"
             @drop.prevent="dragOver = false"
             :class="{ 'bg-blue-100 border-blue-300': dragOver }"
             class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center transition-colors duration-300">

                <template x-if="!fileName">
                    <div>
                        <p class="text-gray-600 mb-2">Drag and drop file excel ke dalam ini, atau klik untuk memilih</p>
                        <label class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer inline-block transition-transform duration-300 ease-in-out transform hover:scale-105">
                            <span>Pilih File Excel</span>
                            <input type="file" x-ref="fileInput" class="hidden" accept=".xlsx, .xls" @change="handleFileSelect">
                        </label>
                    </div>
                </template>

                <template x-if="fileName">
                    <div class="flex items-center justify-center space-x-2">
                        <span class="text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 48 48">
                                <path fill="#169154" d="M29,6H15.744C14.781,6,14,6.781,14,7.744v7.259h15V6z"></path><path fill="#18482a" d="M14,33.054v7.202C14,41.219,14.781,42,15.743,42H29v-8.946H14z"></path><path fill="#0c8045" d="M14 15.003H29V24.005000000000003H14z"></path><path fill="#17472a" d="M14 24.005H29V33.055H14z"></path><g><path fill="#29c27f" d="M42.256,6H29v9.003h15V7.744C44,6.781,43.219,6,42.256,6z"></path><path fill="#27663f" d="M29,33.054V42h13.257C43.219,42,44,41.219,44,40.257v-7.202H29z"></path><path fill="#19ac65" d="M29 15.003H44V24.005000000000003H29z"></path><path fill="#129652" d="M29 24.005H44V33.055H29z"></path></g><path fill="#0c7238" d="M22.319,34H5.681C4.753,34,4,33.247,4,32.319V15.681C4,14.753,4.753,14,5.681,14h16.638 C23.247,14,24,14.753,24,15.681v16.638C24,33.247,23.247,34,22.319,34z"></path><path fill="#fff" d="M9.807 19L12.193 19 14.129 22.754 16.175 19 18.404 19 15.333 24 12.719 23.982 9.526 29 11.912 29 14.013 25.07 16.123 29 18.474 29 15.333 24z"></path>
                            </svg>
                        </span>
                        <p class="text-green-600" x-text="fileName"></p>
                        <button @click="removeFile" class="text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="15" height="15" viewBox="0,0,256,256">
                                <g fill="#44b54c" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(8.53333,8.53333)"><path d="M7,4c-0.25587,0 -0.51203,0.09747 -0.70703,0.29297l-2,2c-0.391,0.391 -0.391,1.02406 0,1.41406l7.29297,7.29297l-7.29297,7.29297c-0.391,0.391 -0.391,1.02406 0,1.41406l2,2c0.391,0.391 1.02406,0.391 1.41406,0l7.29297,-7.29297l7.29297,7.29297c0.39,0.391 1.02406,0.391 1.41406,0l2,-2c0.391,-0.391 0.391,-1.02406 0,-1.41406l-7.29297,-7.29297l7.29297,-7.29297c0.391,-0.39 0.391,-1.02406 0,-1.41406l-2,-2c-0.391,-0.391 -1.02406,-0.391 -1.41406,0l-7.29297,7.29297l-7.29297,-7.29297c-0.1955,-0.1955 -0.45116,-0.29297 -0.70703,-0.29297z"></path></g></g>
                            </svg>
                        </button>
                    </div>
                </template>

            </div>

            <button @click="submitExcel" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-transform duration-300 ease-in-out transform hover:scale-105 mb-8">
                Tambah User dari File Excel
            </button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

@endsection
