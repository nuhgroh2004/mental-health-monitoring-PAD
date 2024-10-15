<!-- resources/views/mood-note.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Note</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#76aeb8] flex justify-center items-center h-[800px]">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[90%]">
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

        <div class="text-center mb-4">
            <span class="text-4xl" id="moodEmoji">😔</span>
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
        <button onclick="goBack()" class="bg-gray-500 text-white px-4 py-2 rounded-lg w-full hover:bg-gray-600 transition duration-300 flex items-center justify-center">
            <svg class="h-5 w-5 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </button>

        <div id="editForm" class="hidden mt-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Select Mood:</label>
                <div class="flex justify-between">
                    <button onclick="selectMood('😊')" class="text-3xl p-2 rounded hover:bg-gray-200">😊</button>
                    <button onclick="selectMood('😐')" class="text-3xl p-2 rounded hover:bg-gray-200">😐</button>
                    <button onclick="selectMood('😔')" class="text-3xl p-2 rounded hover:bg-gray-200">😔</button>
                    <button onclick="selectMood('😄')" class="text-3xl p-2 rounded hover:bg-gray-200">😄</button>
                </div>
            </div>
            <textarea id="noteInput" placeholder="Enter your note" class="w-full p-2 mb-2 border rounded min-h-[200px] "></textarea>
            <button onclick="saveChanges()" class="bg-[#76aeb8] text-white px-4 py-2 rounded-lg w-full hover:bg-[#5a8d96] transition duration-300">Save</button>
        </div>
    </div>

    <script>
        let selectedMood = '😊';

        function toggleEdit() {
            const editForm = document.getElementById('editForm');
            editForm.classList.toggle('hidden');

            if (!editForm.classList.contains('hidden')) {
                selectedMood = document.getElementById('moodEmoji').innerText;
                document.getElementById('noteInput').value = document.getElementById('noteText').innerText;
            }
        }

        function selectMood(mood) {
            selectedMood = mood;
            const buttons = document.querySelectorAll('#editForm button');
            buttons.forEach(button => {
                button.classList.remove('bg-gray-200');
                if (button.innerText === mood) {
                    button.classList.add('bg-gray-200');
                }
            });
        }

        function saveChanges() {
            const noteText = document.getElementById('noteInput').value;

            document.getElementById('moodEmoji').innerText = selectedMood;
            document.getElementById('noteText').innerText = noteText;

            toggleEdit();
        }

        function goBack() {
            window.history.back(); // Fungsi untuk kembali ke halaman sebelumnya
        }
    </script>
</body>
</html>
