
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

    function animateEmoji(emojiButton) {
        if (isAnimating) return;
        isAnimating = true;

        const originalScale = 1;
        const targetScale = 1.2;

        emojiButton.style.transition = 'transform 0.2s ease-in-out';
        emojiButton.style.transform = `scale(${targetScale})`;

        setTimeout(() => {
            emojiButton.style.transform = `scale(${originalScale})`;
            setTimeout(() => {
                emojiButton.style.transition = '';
                isAnimating = false;
                showModal(emojiButton.getAttribute('data-emotion'));
            }, 120);
        }, 120);
    }

    function showModal(emotion) {
        selectedEmotion = emotion;
        document.getElementById('selected-emotion-text').textContent = emotion;
        modal.classList.remove('hidden');
        levelButtons.forEach(btn => btn.classList.remove('bg-blue-500', 'text-white'));
        selectedLevel = null;
        document.getElementById('level-description-text').textContent = ''; // Reset level description text
        document.getElementById('level-description').classList.add('hidden'); // Hide level description
    }

    emojiButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            animateEmoji(this);
        });
    });

    levelButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            levelButtons.forEach(b => b.classList.remove('bg-blue-500', 'text-white'));
            this.classList.add('bg-blue-500', 'text-white');
            selectedLevel = this.getAttribute('data-level');
            updateLevelDescription(selectedEmotion, selectedLevel);
        });
    });

    modalBackButton.addEventListener('click', function() {
        modal.classList.add('hidden');
        selectedLevel = null;
    });

    modalOkButton.addEventListener('click', function () {
        if (selectedLevel) {
            const data = {
                emotion: selectedEmotion,
                level: selectedLevel
            };
            // Simpan data ke localStorage
            localStorage.setItem('selectedEmotion', JSON.stringify(data));

            // Perbarui teks dan tombol emoji
            feelingText.textContent = getFeelingText(data.emotion);
            updateEmojiButtons(selectedEmotion);

            // Tutup modal
            modal.classList.add('hidden');

            // Redirect setelah sedikit delay
            setTimeout(() => {
                window.location.href = "/mahasiswa/notes";
            }, 500);
        } else {
            // Tampilkan alert jika level belum dipilih
            Swal.fire({
                title: "Peringatan",
                text: "Silakan pilih level emosi terlebih dahulu!",
                icon: "warning",
                confirmButtonColor: "#3085d6"
            });
        }
    });


    resetButton.addEventListener('click', function() {
        localStorage.removeItem('selectedEmotion');
        resetUI();
    });

    const savedData = localStorage.getItem('selectedEmotion');
    if (savedData) {
        const data = JSON.parse(savedData);
        feelingText.textContent = getFeelingText(data.emotion);
        updateEmojiButtons(data.emotion);
    }

    function updateLevelDescription(emotion, level) {
        const levelDescriptionText = document.getElementById('level-description-text');
        const levelDescriptionDiv = document.getElementById('level-description');
        levelDescriptionDiv.classList.remove('hidden');

        switch (emotion) {
            case 'Marah':
                if (level == 1) {
                    levelDescriptionText.textContent = "Saya merasa sedikit kesal hari ini.";
                } else if (level == 2) {
                    levelDescriptionText.textContent = "Saya merasa marah hari ini.";
                } else if (level == 3) {
                    levelDescriptionText.textContent = "Saya merasa sangat marah hari ini.";
                }
                break;
            case 'Sedih':
                if (level == 1) {
                    levelDescriptionText.textContent = "Saya merasa sedikit sedih hari ini.";
                } else if (level == 2) {
                    levelDescriptionText.textContent = "Saya merasa sedih hari ini.";
                } else if (level == 3) {
                    levelDescriptionText.textContent = "Saya merasa sangat sedih hari ini.";
                }
                break;
            case 'Biasa saja':
                if (level == 1) {
                    levelDescriptionText.textContent = "Saya merasa biasa saja hari ini.";
                } else if (level == 2) {
                    levelDescriptionText.textContent = "Saya merasa cukup biasa hari ini.";
                } else if (level == 3) {
                    levelDescriptionText.textContent = "Saya merasa benar-benar biasa hari ini.";
                }
                break;
            case 'Senang':
                if (level == 1) {
                    levelDescriptionText.textContent = "Saya merasa sedikit senang hari ini.";
                } else if (level == 2) {
                    levelDescriptionText.textContent = "Saya merasa senang hari ini.";
                } else if (level == 3) {
                    levelDescriptionText.textContent = "Saya merasa sangat senang hari ini.";
                }
                break;
        }
    }

    function getFeelingText(emotion) {
        return `Saya merasa ${emotion} hari ini.`;
    }

    function updateEmojiButtons(selectedEmotion) {
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
    }

    function resetUI() {
        feelingText.textContent = 'HALLO BAGAIMANA PERSAANMU HARI INI';
        emojiButtons.forEach(btn => {
            btn.style.display = 'inline-block';
            btn.style.margin = '';
            btn.classList.remove('mx-auto', 'pointer-events-none');
            btn.style.cursor = 'pointer';
            btn.style.transform = 'scale(1)';
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
            clearInterval(this.timerInterval); // Hentikan timer saat tombol Finish ditekan
            this.isRunning = false;            // Tandai bahwa timer sedang tidak berjalan

            // Perbarui status apakah target tercapai atau belum sebelum menampilkan dialog
            this.isTargetAchieved = this.elapsedTime >= this.targetSeconds;

            // Panggil SweetAlert dan hanya reset jika hasilnya dikonfirmasi
            handleFinishConfirmation(this.isTargetAchieved).then((result) => {
                if (result.isConfirmed) { // Jika pengguna memilih "Ya"
                    this.resetTimer();    // Reset timer
                } else {
                    this.toggleTimer();   // Lanjutkan timer jika pengguna memilih "Tidak"
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
    };
}
