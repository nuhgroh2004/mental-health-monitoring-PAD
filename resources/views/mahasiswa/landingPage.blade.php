@extends('navbar/navbar3')
@section('content')
<title>Home</title>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
<section class="bg-[#76aeb8] min-h-screen flex flex-col items-center justify-center p-4">
    <div id="emoji-container" class="mb-8">
        <h2 id="feeling-text" class="text-2xl font-bold mb-[150px] text-center">HALLO BAGAIMANA PERSAANMU HARI INI</h2>
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
    <!-- Tombol Reset -->
    <button id="reset-btn" class="mt-4 px-6 py-2 bg-[#76aeb8] ">
.
    </button>
</section>




<section class="min-h-screen flex items-center justify-center bg-gradient-to-b from-[#76aeb8] to-[#e9f5f9] p-6">
    <div x-data="timerApp()"
         class="bg-white rounded-lg shadow-xl p-8 w-full max-w-2xl mx-auto">
        <h2 class="text-3xl font-bold mb-8 text-center text-[#76aeb8]">Timer Target Pengerjaan</h2>

        <!-- Bagian Input Target Waktu -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <input type="time" x-model="newTarget"
                       class="w-2/3 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#76aeb8]">
                <button @click="addTarget()"
                        class="bg-[#76aeb8] text-white px-4 py-2 rounded-md hover:bg-[#5a8d96]">
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
                    class="bg-[#76aeb8] hover:bg-[#5a8d96] text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 text-lg">
            </button>
            <button x-show="timerStarted" @click="finishTimer()"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 text-lg">
                Finish
            </button>
        </div>

        <!-- Menampilkan Status Target Tercapai atau Tidak -->
        <div class="flex flex-col items-center">
            <template x-if="timerFinished && isTargetAchieved">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="mt-2 text-lg font-semibold text-green-600">Status: Target Tercapai</p>
                </div>
            </template>
            <template x-if="timerFinished && !isTargetAchieved">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <p class="mt-2 text-lg font-semibold text-red-600">Status: Target Tidak Tercapai</p>
                </div>
            </template>
        </div>
    </div>

    <!-- Alert untuk menunjukkan bahwa timer telah selesai -->
    <div id="finishAlert" class="fixed top-20 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-lg font-bold py-2 px-4 rounded-lg shadow-lg hidden">
        Timer selesai! Data telah disimpan.
    </div>
</section>
<script>
    // section 1
// document.querySelectorAll('.emoji-btn').forEach(button => {
//     button.addEventListener('click', function() {
//         // Tambahkan kelas Tailwind untuk memperbesar
//         this.classList.add('scale-105');

//         // Hapus kelas setelah animasi selesai (200ms, sesuai dengan durasi transisi)
//         setTimeout(() => {
//             this.classList.remove('scale-105');
//         }, 250);
//     });
// });

// document.addEventListener('DOMContentLoaded', function() {
//     const emojiButtons = document.querySelectorAll('.emoji-btn');
//     const feelingText = document.getElementById('feeling-text');

//     emojiButtons.forEach(btn => {
//         btn.addEventListener('click', function() {
//             const emotion = this.dataset.emotion;
//             feelingText.textContent = `saaya merasa ${emotion} hari ini!`;
//             emojiButtons.forEach(b => b.classList.remove('selected'));
//             this.classList.add('selected');
//         });
//     });
// });

document.querySelectorAll('.emoji-btn').forEach(btn => {
        btn.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah pindah halaman langsung

            const selectedEmotion = this.getAttribute('data-emotion');
            localStorage.setItem('selectedEmotion', selectedEmotion); // Simpan di localStorage

            // Sembunyikan semua emoji
            document.querySelectorAll('.emoji-btn').forEach(el => el.style.display = 'none');

            // Tampilkan hanya emoji yang dipilih di tengah
            this.style.display = 'block';
            this.style.margin = '0 auto';
            this.classList.add('mx-auto'); // Tempatkan di tengah layar

            // Setelah menampilkan emoji, arahkan ke halaman tujuan
            setTimeout(() => {
                window.location.href = "{{ route('mahasiswa.notes') }}";
            }, 500); // Tambahkan delay jika diperlukan
        });
    });

    // Tombol Reset untuk mengembalikan tampilan semula
    document.getElementById('reset-btn').addEventListener('click', function() {
        // Hapus data dari localStorage
        localStorage.removeItem('selectedEmotion');

        // Kembalikan semua emoji ke tampilan semula
        document.querySelectorAll('.emoji-btn').forEach(el => {
            el.style.display = 'inline-block';
            el.style.margin = ''; // Hapus margin auto
            el.classList.remove('mx-auto', 'selected'); // Hapus kelas mx-auto dan selected
        });

        // Kembalikan teks ke keadaan semula
        document.getElementById('feeling-text').textContent = 'HALLO BAGAIMANA PERSAANMU HARI INI';
    });

    // Jika ada data tersimpan, tampilkan emoji yang sudah dipilih sebelumnya
    const savedEmotion = localStorage.getItem('selectedEmotion');
    if (savedEmotion) {
        document.querySelectorAll('.emoji-btn').forEach(btn => {
            if (btn.getAttribute('data-emotion') !== savedEmotion) {
                btn.style.display = 'none';
            } else {
                btn.style.display = 'block';
                btn.style.margin = '0 auto'; // Tambahkan margin auto untuk memastikan di tengah
                btn.classList.add('mx-auto'); // Tempatkan di tengah
            }
        });
    }

document.querySelectorAll('.emoji-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Tambahkan kelas Tailwind untuk memperbesar
        this.classList.add('scale-105');

        // Hapus kelas setelah animasi selesai (200ms, sesuai dengan durasi transisi)
        setTimeout(() => {
            this.classList.remove('scale-105');
        }, 250);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const emojiButtons = document.querySelectorAll('.emoji-btn');
    const feelingText = document.getElementById('feeling-text');
    const resetButton = document.getElementById('reset-btn');

    // Fungsi untuk mengatur emoji yang dipilih dan menyimpan di localStorage
    emojiButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const emotion = this.dataset.emotion;

            // Set text sesuai dengan emoji yang dipilih
            feelingText.textContent = `Saya merasa ${emotion} hari ini!`;

            // Hapus kelas 'selected' dari semua emoji dan tambahkan ke yang dipilih
            emojiButtons.forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');

            // Simpan emoji yang dipilih di localStorage
            localStorage.setItem('selectedEmotion', emotion);
        });
    });

    // Fungsi untuk mereset emoji yang dipilih dan teks
    resetButton.addEventListener('click', function() {
        // Hapus data dari localStorage
        localStorage.removeItem('selectedEmotion');

        // Kembalikan teks ke keadaan semula
        feelingText.textContent = 'HALLO BAGAIMANA PERSAANMU HARI INI';

        // Hapus kelas 'selected' dari semua emoji
        emojiButtons.forEach(b => b.classList.remove('selected'));
    });

    // Cek apakah ada pilihan emoji yang tersimpan di localStorage
    const savedEmotion = localStorage.getItem('selectedEmotion');
    if (savedEmotion) {
        // Tampilkan emoji yang dipilih sebelumnya
        feelingText.textContent = `Saya merasa ${savedEmotion} hari ini!`;

        // Tambahkan kelas 'selected' ke emoji yang sesuai
        emojiButtons.forEach(btn => {
            if (btn.dataset.emotion === savedEmotion) {
                btn.classList.add('selected');
            }
        });
    }
});

// section 1

function timerApp() {
            return {
                newTarget: '00:00',
                targetSeconds: 0,
                elapsedTime: 0,
                isRunning: false,
                timerInterval: null,
                timerStarted: false,
                timerFinished: false,
                isTargetAchieved: false,

                // Tambahkan target waktu berdasarkan inputan (format jam dan menit)
                addTarget() {
                    const [hours, minutes] = this.newTarget.split(':').map(Number);

                    // Cek apakah waktu yang dimasukkan valid
                    if (hours === 0 && minutes === 0) {
                        alert("Waktu target tidak boleh 00:00. Silakan masukkan waktu yang valid.");
                        return;
                    }

                    // Konversi waktu ke detik
                    this.targetSeconds = (hours * 3600) + (minutes * 60);
                    this.newTarget = '00:00';
                },

                // Mulai timer
                startTimer() {
                    if (this.targetSeconds > 0) {
                        this.timerStarted = true;
                        this.toggleTimer();
                    } else {
                        alert('Please add a target before starting the timer.');
                    }
                },

                // Pause/Play timer
                toggleTimer() {
                    if (this.isRunning) {
                        clearInterval(this.timerInterval);
                    } else {
                        this.timerInterval = setInterval(() => {
                            this.elapsedTime++;
                        }, 1000);
                    }
                    this.isRunning = !this.isRunning;
                },

                // Menghentikan timer dan mengecek apakah target tercapai
                finishTimer() {
                    clearInterval(this.timerInterval);
                    this.isRunning = false;
                    this.timerFinished = true;

                    // Cek apakah target tercapai
                    this.isTargetAchieved = this.elapsedTime >= this.targetSeconds;

                    // Tampilkan alert bahwa timer selesai
                    this.showAlert('finishAlert');
                },

                // Format waktu dalam format jam:menit:detik
                formatTime(seconds) {
                    const hours = Math.floor(seconds / 3600);
                    const minutes = Math.floor((seconds % 3600) / 60);
                    const remainingSeconds = seconds % 60;
                    return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(remainingSeconds).padStart(2, '0')}`;
                },

                // Tampilkan alert untuk beberapa detik, lalu reset timer
                showAlert(alertId) {
                    const alertElement = document.getElementById(alertId);
                    alertElement.classList.remove('hidden');
                    setTimeout(() => {
                        alertElement.classList.add('hidden');
                        this.resetTimer();
                    }, 3000); // Sembunyikan alert setelah 3 detik
                },

                // Reset timer dan semua status
                resetTimer() {
                    this.elapsedTime = 0;
                    this.targetSeconds = 0;
                    this.timerStarted = false;
                    this.timerFinished = false;
                    this.isTargetAchieved = false;
                    this.newTarget = '00:00';
                }
            };
        }
</script>

@endsection
