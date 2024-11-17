@extends('navbar/navbar-mahasiswa')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Home</title>


<body class="flex items-center justify-center bg-gray-100 h-screen">
    <div class="flex flex-col md:flex-row w-full h-full mt-[60px]">
        <!-- Sidebar -->
        <div class="sidebar flex-col w-[100px] bg-white text-black p-4 items-center hidden md:flex ml-4 mb-4 rounded-lg mt-[54px] shadow-lg">
            <div class="btn-mood  flex-col w-[80px] h-[90px] mb-4 rounded-lg backdrop-blur-md bg-opacity-50 hover:bg-[#3ad1ff] transition-colors duration-300 flex items-center justify-center">
                <img class="w-[40px] h-[40px]" src="{{ asset('assets/svg/icon-mood-trakker.svg') }}" alt="Logo" class="">
                <span class="text-sm text-center">Mood Tracker</span>
            </div>
            <div class="btn-target flex-col w-[80px] h-[90px] rounded-lg backdrop-blur-md bg-opacity-50 hover:bg-[#3ad1ff] transition-colors duration-300 flex items-center justify-center">
                <img class="w-[40px] h-[40px]" src="{{ asset('assets/svg/icon-target.svg') }}" alt="Logo" class="">
                <span class="text-sm text-center"> Timer</span>
            </div>
        </div>
        <div class="top-bar flex flex-col w-full">
            <!-- Top Bar (Visible on small screens) -->
            <div class="flex md:hidden bg-white p-4 items-center mt-[70px] rounded-lg m-4 h-[70px] shadow-lg" >
                <div class="btn-mood w-[180px] h-[50px] rounded-lg mr-3 hover:bg-[#3ad1ff] transition-colors duration-300 flex items-center justify-center">
                    <img class="w-[40px] h-[40px]" src="{{ asset('assets/svg/icon-mood-trakker.svg') }}" alt="Logo" class="">
                    <span class="text-lg text-center ml-2">Mood Tracker</span>
                </div>
                <div class="btn-target w-[110px] h-[50px] rounded-lg ml-3 hover:bg-[#3ad1ff] transition-colors duration-300 flex items-center justify-center">
                    <img class="w-[40px] h-[40px]" src="{{ asset('assets/svg/icon-target.svg') }}" alt="Logo" class="">
                    <span class="text-lg text-center ml-2">Timer</span>
                </div>
            </div>


            <!-- mood section -->
            <div class="mood flex-1 p-4 w-full h-full mt-[-30px]">
                <div class="w-full h-full bg-cover bg-center rounded-lg overflow-hidden shadow-lg">
                    <div class=" flex flex-col items-center justify-center p-4">
                        <div id="emoji-container" class="mb-8">
                            <h2 id="feeling-text" class="text-emoji text-2xl font-bold text-center">HALLO BAGAIMANA PERSAANMU HARI INI</h2>
                            <div class="flex space-x-4">
                                <a href="{{ route('mahasiswa.notes') }}" class="emoji-btn inline-block transition-transform transform" data-emotion="Marah">
                                    <img src="{{ asset('asset/svg/emoji/marah.svg') }}" alt="Marah Emoji" class="inline-block">
                                </a>
                                <a href="{{ route('mahasiswa.notes') }}" class="emoji-btn inline-block transition-transform transform" data-emotion="Sedih">
                                    <img src="{{ asset('asset/svg/emoji/sedih.svg') }}" alt="Sedih Emoji" class="inline-block">
                                </a>
                                <a href="{{ route('mahasiswa.notes') }}" class="emoji-btn inline-block transition-transform transform" data-emotion="Biasa saja">
                                    <img src="{{ asset('asset/svg/emoji/biasaSaja.svg') }}" alt="Biasa Saja Emoji" class="inline-block">
                                </a>
                                <a href="{{ route('mahasiswa.notes') }}" class="emoji-btn inline-block transition-transform transform" data-emotion="Senang">
                                    <img src="{{ asset('asset/svg/emoji/happy.svg') }}" alt="Happy Emoji" class="inline-block">
                                </a>
                            </div>
                        </div>
                        <!-- Popup Modal -->
                        <!-- Modal untuk menampilkan level emosi -->
                        <div id="emotion-level-modal" class="emotion-level fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full m-4">
                                <h3 class="text-xl font-bold mb-4 text-center">Seberapa <span id="selected-emotion-text"></span> kamu?</h3>

                                <!-- Level Buttons -->
                                <div class="flex justify-center space-x-2 mb-6">
                                    <button class="level-btn w-12 h-12 rounded-full border-2 hover:bg-blue-100 transition-colors" data-level="1">1</button>
                                    <button class="level-btn w-12 h-12 rounded-full border-2 hover:bg-blue-100 transition-colors" data-level="2">2</button>
                                    <button class="level-btn w-12 h-12 rounded-full border-2 hover:bg-blue-100 transition-colors" data-level="3">3</button>
                                </div>

                                <!-- Penjelasan Level -->
                                <div id="level-description" class="text-center mb-4 hidden">
                                    <p id="level-description-text"></p>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex justify-center space-x-4">
                                    <button id="modal-back" class="w-24 px-6 py-2 bg-gray-200 rounded hover:bg-gray-300 transition-colors text-center">Kembali</button>
                                    <a id="modal-ok" class="w-24 px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors text-center">OK</a>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Reset -->
                        <button id="reset-btn" class="mt-4 px-6 py-2 bg-[#76aeb8] ">
                    .
                        </button>
                    </div>
                </div>
            </div>


            <!-- Target Section -->
            <div class="target flex-1 p-4 w-full hidden">
                <div class=" flex items-center  mt-10 justify-center ">
                    <div x-data="timerApp()"
                         class="bg-white rounded-lg p-8 w-full max-w-2xl mx-auto ">
                        <h2 class="text-3xl font-bold mb-8 text-center text-[#76aeb8]">Timer Target Pengerjaan</h2>

                        <!-- Bagian Input Target Waktu -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <input type="time" x-model="newTarget"
                                       class="w-2/3 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#76aeb8]">
                                <button @click="addTarget()"
                                        class="btn-tambah bg-[#76aeb8] text-white px-4 py-2 rounded-md hover:bg-[#5a8d96]">
                                    Tambah Target
                                </button>
                            </div>
                            <div x-show="targetSeconds > 0 && !timerStarted" class="mt-4 text-lg font-semibold mb-2 text-[#76aeb8]">
                                Target Waktu: <span x-text="formatTime(targetSeconds)"></span>
                            </div>
                            <button x-show="!timerStarted" @click="startTimer()"
                                    class="w-full bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                Mulai Timer
                            </button>
                        </div>

                        <!-- Menampilkan Waktu Target dan Waktu Tercapai -->
                        <div x-show="timerStarted" class="mb-8">
                            <div class="flex justify-between items-center mb-4 bg-gray-100 p-4 rounded-lg">
                                <div class="text-lg font-semibold">
                                    <div>Target: <span x-text="formatTime(targetSeconds)" class="text-[#76aeb8]"></span></div>
                                </div>
                                <div class="text-lg font-semibold">
                                    <div>Tercapai: <span x-text="formatTime(elapsedTime)" class="text-green-600"></span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Tampilan Lingkaran Timer -->
                        <div class="flex justify-center mb-8">
                            <div class="timer-circle">
                                <div class="timer-text" x-text="formatTime(elapsedTime)"></div>
                            </div>
                        </div>

                        <!-- Tombol untuk Pause/Play dan Finish -->
                        <div class="flex justify-center space-x-6 mb-8">
                            <button x-show="timerStarted" @click="toggleTimer()"
                                    x-text="isRunning ? 'Pause' : 'Play'"
                                    class="bg-[#76aeb8] hover:bg-[#5a8d96] text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 text-lg"
                                    style="min-width: 100px;">
                            </button>
                            <button x-show="timerStarted" @click="finishTimer()"
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 text-lg">
                                Finish
                            </button>
                        </div>

                        <!-- Menampilkan Status Target Tercapai atau Tidak -->

                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('assets/js/mhs-home.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
<script>
// Constants for DOM elements
const modal = document.getElementById('emotion-level-modal');
const emotionText = document.getElementById('selected-emotion-text');
const levelDescriptionText = document.getElementById('level-description-text');
const levelDescriptionDiv = document.getElementById('level-description');
const backButton = document.getElementById('modal-back');
const okButton = document.getElementById('modal-ok');
const levelButtons = document.querySelectorAll('.level-btn');

// Variables to store selections
let selectedEmotion = '';
let selectedLevel = null;

// Attach click handlers to emoji buttons
document.querySelectorAll('.emoji-btn').forEach(btn => {
    btn.addEventListener('click', (event) => {
        event.preventDefault();
        selectedEmotion = btn.dataset.emotion;

        // Store emotion in session storage
        sessionStorage.setItem('selectedEmotion', selectedEmotion);

        // Update modal text and show modal
        emotionText.textContent = selectedEmotion;
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Reset level selection
        selectedLevel = null;
        levelButtons.forEach(button => {
            button.classList.remove('bg-blue-500', 'text-white');
            button.classList.add('bg-white');
        });
        levelDescriptionDiv.classList.add('hidden'); // Hide description on new selection
    });
});

// Attach click handlers to level buttons
levelButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        const level = btn.dataset.level;
        selectedLevel = level;

        // Update visual feedback for selected level
        levelButtons.forEach(button => {
            button.classList.remove('bg-blue-500', 'text-white');
            button.classList.add('bg-white');
        });
        btn.classList.remove('bg-white');
        btn.classList.add('bg-blue-500', 'text-white');

        // Show emotion level description
        levelDescriptionDiv.classList.remove('hidden');
        levelDescriptionText.textContent = getEmotionLevelDescription(selectedEmotion, parseInt(level));
    });
});

// Function to generate level description
function getEmotionLevelDescription(emotion, level) {
    switch (level) {
        case 1:
            return `Level 1: Kamu merasa sedikit ${emotion.toLowerCase()}.`;
        case 2:
            return `Level 2: Kamu merasa agak ${emotion.toLowerCase()}.`;
        case 3:
            return `Level 3: Kamu merasa sangat ${emotion.toLowerCase()}.`;
        default:
            return '';
    }
}

// Handle back button click
backButton.addEventListener('click', () => {
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    selectedLevel = null;
});

// Handle OK button click
okButton.addEventListener('click', () => {
    if (!selectedLevel) {
        const errorMsg = document.createElement('div');
        errorMsg.className = 'text-red-500 text-sm mt-2';
        errorMsg.textContent = 'Pilih level intensitas terlebih dahulu';
        modal.querySelector('.level-btn').parentElement.appendChild(errorMsg);
        setTimeout(() => errorMsg.remove(), 3000);
        return;
    }

    sessionStorage.setItem('selectedIntensity', selectedLevel);
    window.location.href = okButton.href || '/mahasiswa/notes';
});

// When the page loads on the notes page, populate fields from session storage
if (window.location.pathname.includes('notes')) {
    window.addEventListener('load', () => {
        const emotion = sessionStorage.getItem('selectedEmotion');
        const intensity = sessionStorage.getItem('selectedIntensity');
        const emotionDisplay = document.getElementById('emotion-display');
        const intensityDisplay = document.getElementById('intensity-display');
        const emotionInput = document.getElementById('selectedEmotion');
        const intensityInput = document.getElementById('selectedIntensity');

        if (emotionDisplay && emotionInput) emotionDisplay.textContent = emotion;
        if (intensityDisplay && intensityInput) intensityDisplay.textContent = intensity;
        if (emotionInput) emotionInput.value = emotion;
        if (intensityInput) intensityInput.value = intensity;

        if (!emotion || !intensity) {
            window.location.href = '/mahasiswa/home';
        }
    });
}
</script>


@endsection
