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
                window.location.href = "/mahasiswa/notes"; // Replace with the actual URL
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

// pindah menenu ke target
const moodButtons = document.querySelectorAll('.btn-mood');
const targetButtons = document.querySelectorAll('.btn-target');
const moodSection = document.querySelector('.mood');
const targetSection = document.querySelector('.target');
const sidebar = document.querySelector('.sidebar'); // Assuming you have a sidebar element

// Add event listeners to all 'btn-mood' buttons
moodButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        moodSection.classList.remove('hidden');
        targetSection.classList.add('hidden');
        sidebar.style.height = 'auto'; // Reset sidebar height
        sidebar.style.marginBottom = '0'; // Reset margin bottom
    });
});

// Add event listeners to all 'btn-target' buttons
targetButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        moodSection.classList.add('hidden');
        targetSection.classList.remove('hidden');
        sidebar.style.height = '643px'; // Change sidebar height
        sidebar.style.marginBottom = '40px'; // Add margin bottom
    });
});
// pindah menenu ke target



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
