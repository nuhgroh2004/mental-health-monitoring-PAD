@extends('navbar/navbar3')
@section('content')
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>GamaPulse</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicons -->
    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
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
    <!-- Popup Modal -->
    <div id="emotion-level-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full m-4">
            <h3 class="text-xl font-bold mb-4 text-center">Seberapa <span id="selected-emotion-text"></span> kamu?</h3>

            <!-- Level Buttons -->
            <div class="flex justify-between mb-6">
                <button class="level-btn w-12 h-12 rounded-full border-2 hover:bg-blue-100 transition-colors" data-level="1">1</button>
                <button class="level-btn w-12 h-12 rounded-full border-2 hover:bg-blue-100 transition-colors" data-level="2">2</button>
                <button class="level-btn w-12 h-12 rounded-full border-2 hover:bg-blue-100 transition-colors" data-level="3">3</button>
                <button class="level-btn w-12 h-12 rounded-full border-2 hover:bg-blue-100 transition-colors" data-level="4">4</button>
                <button class="level-btn w-12 h-12 rounded-full border-2 hover:bg-blue-100 transition-colors" data-level="5">5</button>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-center space-x-4">
                <button id="modal-back" class="w-24 px-6 py-2 bg-gray-200 rounded hover:bg-gray-300 transition-colors text-center">Kembali</button>
                <button id="modal-ok" class="w-24 px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">OK</button>
            </div>
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
                    class="bg-[#76aeb8] hover:bg-[#5a8d96] text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 text-lg"
                    style="min-width: 100px;">
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

document.addEventListener('DOMContentLoaded', function() {
    const emojiButtons = document.querySelectorAll('.emoji-btn');
    const modal = document.getElementById('emotion-level-modal');
    const levelButtons = document.querySelectorAll('.level-btn');
    const modalOkButton = document.getElementById('modal-ok');
    const modalBackButton = document.getElementById('modal-back');
    const feelingText = document.getElementById('feeling-text');
    const resetButton = document.getElementById('reset-btn');

    let selectedEmotion = '';
    let selectedLevel = null;
    let isAnimating = false;

    // Fungsi untuk animasi pembesaran emoji
    function animateEmoji(emojiButton) {
        if (isAnimating) return;
        isAnimating = true;

        // Simpan ukuran dan posisi awal
        const originalScale = 1;
        const targetScale = 1.2; // Perkecil skala animasi

        // Tambahkan transition untuk animasi yang smooth
        emojiButton.style.transition = 'transform 0.2s ease-in-out'; // Perpendek durasi animasi

        // Efek membesar
        emojiButton.style.transform = `scale(${targetScale})`;

        // Kembali ke ukuran semula setelah animasi selesai
        setTimeout(() => {
            emojiButton.style.transform = `scale(${originalScale})`;
            setTimeout(() => {
                emojiButton.style.transition = '';
                isAnimating = false;
                showModal(emojiButton.getAttribute('data-emotion'));
            }, 120);
        }, 120);
    }

    // Fungsi untuk menampilkan modal
    function showModal(emotion) {
        selectedEmotion = emotion;
        document.getElementById('selected-emotion-text').textContent = emotion;
        modal.classList.remove('hidden');
        // Reset level selection
        levelButtons.forEach(btn => btn.classList.remove('bg-blue-500', 'text-white'));
        selectedLevel = null;
    }

    // Event listener untuk emoji buttons
    emojiButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            animateEmoji(this);
        });
    });

    // Event listener untuk level buttons
    levelButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove selected class from all buttons
            levelButtons.forEach(b => b.classList.remove('bg-blue-500', 'text-white'));
            // Add selected class to clicked button
            this.classList.add('bg-blue-500', 'text-white');
            selectedLevel = this.getAttribute('data-level');
        });
    });

    // Event listener untuk tombol Kembali
    modalBackButton.addEventListener('click', function() {
        modal.classList.add('hidden');
        selectedLevel = null;
    });

    // Event listener untuk tombol OK
    modalOkButton.addEventListener('click', function() {
        if (selectedLevel) {
            // Simpan data di localStorage
            const data = {
                emotion: selectedEmotion,
                level: selectedLevel
            };
            localStorage.setItem('selectedEmotion', JSON.stringify(data));

            // Update UI
            feelingText.textContent = `Saya merasa ${selectedEmotion} level ${selectedLevel} hari ini!`;

            // Sembunyikan emoji lain dan tampilkan hanya yang dipilih
            emojiButtons.forEach(btn => {
                if (btn.getAttribute('data-emotion') !== selectedEmotion) {
                    btn.style.display = 'none';
                } else {
                    btn.style.display = 'block';
                    btn.style.margin = '0 auto';
                    btn.classList.add('mx-auto', 'pointer-events-none');
                    btn.style.cursor = 'default';
                }
            });

            // Tutup modal
            modal.classList.add('hidden');

            // Redirect setelah delay
            setTimeout(() => {
                window.location.href = "{{ route('mahasiswa.notes') }}";
            }, 500);
        }
    });

    // Event listener untuk tombol Reset
    resetButton.addEventListener('click', function() {
        // Hapus data dari localStorage
        localStorage.removeItem('selectedEmotion');

        // Reset UI
        feelingText.textContent = 'HALLO BAGAIMANA PERSAANMU HARI INI';

        // Reset tampilan emoji
        emojiButtons.forEach(btn => {
            btn.style.display = 'inline-block';
            btn.style.margin = '';
            btn.classList.remove('mx-auto', 'pointer-events-none');
            btn.style.cursor = 'pointer';
            btn.style.transform = 'scale(1)';  // Reset scale
        });
    });

    // Check localStorage saat halaman dimuat
    const savedData = localStorage.getItem('selectedEmotion');
    if (savedData) {
        const data = JSON.parse(savedData);
        feelingText.textContent = `Saya merasa ${data.emotion} level ${data.level} hari ini!`;

        emojiButtons.forEach(btn => {
            if (btn.getAttribute('data-emotion') !== data.emotion) {
                btn.style.display = 'none';
            } else {
                btn.style.display = 'block';
                btn.style.margin = '0 auto';
                btn.classList.add('mx-auto', 'pointer-events-none');
                btn.style.cursor = 'default';
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
