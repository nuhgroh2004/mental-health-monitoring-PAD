<link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
@vite('resources/css/app.css')
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<title>Edit Profil</title>
<div class="min-h-screen bg-white p-2 sm:p-4 md:p-6 lg:p-8 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6 md:p-8 w-full ">
        <form onsubmit="return false;" class="space-y-4 md:space-y-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" value="user@example.com">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nama
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" value="John Doe">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Leave blank to keep current password">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="NIM">
                    NIM
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nim" type="text" placeholder="Leave blank to keep current password">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for=" prodi">
                    Prodi
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="prodi" type="text" placeholder="Leave blank to keep current password">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="NIM">
                    Tanggal Lahir
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Tanggal Lahir" type="date" placeholder="Leave blank to keep current password">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="NIM">
                    Phon Number
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="number" placeholder="Leave blank to keep current password">
            </div>

            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <button onclick="window.location='{{ route('mahasiswa.profil') }}'" type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full sm:w-1/2 flex items-center justify-center">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </button>
                <button onclick="saveChanges()" type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full sm:w-1/2 flex items-center justify-center">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets/js/mahasiswa/mhs-profil.js') }}"></script>
