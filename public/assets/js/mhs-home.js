document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('emotion-level-modal');
    const levelButtons = document.querySelectorAll('.level-btn');
    const emojiButtons = document.querySelectorAll('.emoji-btn');
    const backButton = document.getElementById('modal-back');
    const okButton = document.getElementById('modal-ok');
    const feelingText = document.getElementById('feeling-text');
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
    function resetLevelSelection() {
        levelButtons.forEach(btn => btn.classList.remove('bg-blue-500', 'text-white'));
        selectedLevel = null;
    }


    // Fungsi untuk menampilkan modal
    function showModal(emotion) {
        selectedEmotion = emotion;
        document.getElementById('selected-emotion-text').textContent = emotion;
        modal.classList.remove('hidden');
        resetLevelSelection();
    }

    // Event listener untuk emoji buttons
    emojiButtons.forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            showModal(btn.dataset.emotion);
        });
    });

    // Event listener untuk level buttons
    levelButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            resetLevelSelection();
            btn.classList.add('bg-blue-500', 'text-white');
            selectedLevel = btn.dataset.level;
        });
    });

    // Event listener untuk tombol Kembali
    backButton.addEventListener('click', () => {
        modal.classList.add('hidden');
        resetLevelSelection();
    });

    // Event listener untuk tombol OK
    okButton.addEventListener('click', () => {
        if (!selectedLevel) {
            alert('Pilih level intensitas terlebih dahulu!');
            return;
        }
        sessionStorage.setItem('selectedEmotion', selectedEmotion);
        sessionStorage.setItem('selectedIntensity', selectedLevel);
        window.location.href = '/mahasiswa/notes';
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


function handleFinishConfirmation(isTargetAchieved) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success w-24 mx-2",
            cancelButton: "btn btn-danger w-24 mx-2"
        },
        buttonsStyling: false
    });

    return swalWithBootstrapButtons.fire({
        title: "Apa kamu yakin?",
        text: "Ingin menyelesaikan timer dan mengecek target?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya!",
        cancelButtonText: "Tidak!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            const message = isTargetAchieved
                ? { title: "Target Tercapai!", text: "Selamat! Waktu yang ditentukan telah tercapai.", icon: "success" }
                : { title: "Target Belum Tercapai", text: "Waktu yang ditentukan belum tercapai.", icon: "error" };

            return swalWithBootstrapButtons.fire(message).then(() => result); // Kembalikan hasil konfirmasi "Ya"
        }
        return result; // Jika pengguna memilih "Tidak", kembalikan hasil tanpa perubahan
    });
}

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
            if (hours === 0 && minutes === 0) {
                alert("Waktu target tidak boleh 00:00. Silakan masukkan waktu yang valid.");
                return;
            }
            this.targetSeconds = (hours * 3600) + (minutes * 60);
            this.newTarget = '00:00';
        },

        startTimer() {
            if (this.targetSeconds > 0) {
                this.timerStarted = true;
                this.toggleTimer();
            } else {
                alert('Please add a target before starting the timer.');
            }
        },

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

        finishTimer() {
            clearInterval(this.timerInterval);
            this.isRunning = false;
            this.isTargetAchieved = this.elapsedTime >= this.targetSeconds;

            const self = this; // Store reference to 'this' for use in Promise

            Swal.fire({
                title: 'Selesai!',
                text: this.isTargetAchieved ?
                    'Selamat! Anda telah mencapai target waktu.' :
                    'Anda belum mencapai target waktu. Apakah anda ingin menyimpan progress?',
                icon: this.isTargetAchieved ? 'success' : 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Prepare the data for the API call
                    const data = {
                        expected_target: self.targetSeconds,
                        actual_target: self.elapsedTime,
                        is_achieved: self.isTargetAchieved
                    };

                    // Get CSRF token from meta tag
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Make the API call
                    fetch('/progress/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Progress berhasil disimpan',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                self.resetTimer();
                            });
                        } else {
                            throw new Error(data.message || 'Gagal menyimpan progress');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: error.message || 'Terjadi kesalahan saat menyimpan progress',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            self.toggleTimer(); // Resume timer if save fails
                        });
                    });
                } else {
                    self.toggleTimer(); // Resume timer if user clicks "Tidak"
                }
            });
        },


        formatTime(seconds) {
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const remainingSeconds = seconds % 60;
            return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(remainingSeconds).padStart(2, '0')}`;
        },

        resetTimer() {
            this.elapsedTime = 0;
            this.targetSeconds = 0;
            this.timerStarted = false;
            this.timerFinished = false;
            this.isTargetAchieved = false;
            this.isRunning = false;
            this.newTarget = '00:00';

            // Memaksa tampilan Alpine untuk memperbarui setelah reset
            this.$nextTick(() => {
                this.elapsedTime = 0;
            });
        }
    }
}
