<!-- resources/views/mood-note.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    <title>GamaPulse</title>

    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">

    @vite('resources/css/app.css')
</head>
<body class="bg-white flex justify-center items-center h-full mt-4 mb-4">
    <div class="container bg-white p-6 rounded-lg shadow-lg w-[90%]">
        <div class="flex justify-between items-center mb-4 text-[#76aeb8]">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                </svg>
                {{ date('d/m/Y') }}
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                </svg>
                {{ date('H:i') }}
            </div>
        </div>

        <div class="text-center mb-4 ">
            <span class="text-4xl " id="moodEmoji">
                <img src="{{ asset('asset/svg/emojiKecil/marah.svg') }}" alt="Mood Emoji" class="inline-block w-[100px] h-[100px]">
            </span>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg mb-4 min-h-[200px]">
            <p id="noteText" class="text-gray-800">Belum ada satu bulan
                Ku yakin masih ada sisa wangiku di bajumu
                Namun kau tampak baik saja
                Bahkan senyummu lebih lepas
                Sedang aku di sini hampir gila
                </p>
        </div>

        <button onclick="toggleEdit()" class="bg-[#76aeb8] text-white px-4 py-2 rounded-lg w-full hover:bg-[#5a8d96] transition duration-300 flex items-center justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
            Edit
        </button>

        <!-- Tombol Kembali -->
        <button onclick="history.back()" class="bg-gray-500 text-white px-4 py-2 rounded-lg w-full hover:bg-gray-600 transition duration-300 flex items-center justify-center">
            <svg class="h-5 w-5 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </button>

        <div id="editForm" class="hidden mt-4 ">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Select Mood:</label>
                <div class="flex justify-between">
                    <button onclick="selectMood(this, '{{ asset('asset/svg/emojiKecil/marah.svg') }}')" class="mood-button p-2 rounded hover:bg-gray-200 bg-white">
                        <img src="{{ asset('asset/svg/emojiKecil/marah.svg') }}" alt="Marah" class="w-[100px] h-[100px]">
                    </button>
                    <button onclick="selectMood(this, '{{ asset('asset/svg/emojiKecil/sedih.svg') }}')" class="mood-button p-2 rounded hover:bg-gray-200 bg-white">
                        <img src="{{ asset('asset/svg/emojiKecil/sedih.svg') }}" alt="Sedih" class="w-[100px] h-[100px]">
                    </button>
                    <button onclick="selectMood(this, '{{ asset('asset/svg/emojiKecil/biasaSaja.svg') }}')" class="mood-button p-2 rounded hover:bg-gray-200 bg-white">
                        <img src="{{ asset('asset/svg/emojiKecil/biasaSaja.svg') }}" alt="Senyum" class="w-[100px] h-[100px]">
                    </button>
                    <button onclick="selectMood(this, '{{ asset('asset/svg/emojiKecil/senang.svg') }}')" class="mood-button p-2 rounded hover:bg-gray-200 bg-white">
                        <img src="{{ asset('asset/svg/emojiKecil/senang.svg') }}" alt="Tertawa" class="w-[100px] h-[100px]">
                    </button>
                </div>
                <style>
                    .selected {
                        background-color: #3399ab;
                        color: white;
                    }
                </style>
            </div>
            <textarea id="noteInput" placeholder="Enter your note" class="w-full p-2 mb-2 border rounded min-h-[200px]"></textarea>
            <button onclick="saveChanges()" class="bg-[#76aeb8] text-white px-4 py-2 rounded-lg w-full hover:bg-[#5a8d96] transition duration-300 flex items-center justify-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan
            </button>
        </div>
    </div>
    <script src="{{ asset('assets/js/mahasiswa/mhs-edit-mood-notes.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

</body>
</html>
