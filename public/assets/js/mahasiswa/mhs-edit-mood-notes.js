let selectedMood = '{{ asset("asset/svg/emojiKecil/marah.svg") }}';
let selectedMoodLevel = 3; // Default mood level (3 adalah 'Marah')
let selectedButton = null;
let originalMood = selectedMood;
let originalNoteText = '';

function toggleEdit() {
    const editForm = document.getElementById('editForm');
    editForm.classList.toggle('hidden');

    if (!editForm.classList.contains('hidden')) {
        // Simpan nilai asli mood dan catatan
        originalMood = document.querySelector('#moodEmoji img').src;
        originalNoteText = document.getElementById('noteText').innerText;

        // Set nilai selectedMood dan input catatan
        selectedMood = originalMood;
        document.getElementById('noteInput').value = originalNoteText;

        // Scroll to the edit form
        editForm.scrollIntoView({ behavior: 'smooth' });
    }
}

function selectMood(button, mood, moodLevel) {
    if (selectedButton) {
        selectedButton.classList.remove('selected');
    }

    // Menandai tombol yang dipilih
    button.classList.add('selected');
    selectedMood = mood;
    selectedButton = button;

    // Tentukan emosi berdasarkan level mood yang dikirimkan
    switch (moodLevel) {
        case 1:
            selectedEmotion = 'Marah';
            break;
        case 2:
            selectedEmotion = 'Sedih';
            break;
        case 3:
            selectedEmotion = 'Biasa saja';
            break;
        case 4:
            selectedEmotion = 'Senang';
            break;
    }

    // Reset level selection dan tampilkan modal
    showEmotionLevelModal();
}

function updateLevelDescription(emotion, level) {
    const levelDescriptionText = document.getElementById('level-description-text');
    const levelDescriptionDiv = document.getElementById('level-description');
    levelDescriptionDiv.classList.remove('hidden'); // Tampilkan deskripsi level

    // Berikan deskripsi level berdasarkan emosi dan tingkat intensitas
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

function showEmotionLevelModal() {
    const modal = document.getElementById('emotion-level-modal');
    document.getElementById('selected-emotion-text').textContent = selectedEmotion;

    // Reset pilihan level sebelumnya
    selectedLevel = null;
    const levelButtons = document.querySelectorAll('.level-btn');
    levelButtons.forEach(btn => btn.classList.remove('bg-blue-500', 'text-white'));

    // Sembunyikan deskripsi level hingga level dipilih
    document.getElementById('level-description').classList.add('hidden');
    document.getElementById('level-description-text').textContent = '';

    // Tampilkan modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}


function saveChanges() {
    const noteText = document.getElementById('noteInput').value;

    // Kirim data mood_level dan mood_note ke backend
    fetch(`/update-mood-note/${moodId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            mood_level: selectedMoodLevel, // Anda dapat menyimpan mood level di sini, pastikan nilai ini sesuai dengan ID emoji
            mood_note: noteText
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire('Sukses!', 'Catatan berhasil disimpan!', 'success');
            document.getElementById('noteText').innerText = noteText;
            toggleEdit(); // Tutup form edit
        } else {
            Swal.fire('Error!', 'Gagal menyimpan catatan.', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error!', 'Terjadi kesalahan server.', 'error');
    });

}
