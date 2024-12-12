let selectedMood = '{{ asset("asset/svg/emojiKecil/marah.svg") }}';
let selectedButton = null;
let selectedLevel = null; // Track selected level
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

    // Tandai tombol yang dipilih
    button.classList.add('selected');
    selectedMood = mood;
    selectedButton = button;
    selectedMoodLevel = moodLevel; // Langsung set level saat mood dipilih

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

    // Tampilkan modal untuk memilih level
    showEmotionLevelModal();
}


document.querySelectorAll('.mood-button').forEach(button => {
    button.addEventListener('click', function() {
        const moodLevel = parseInt(this.getAttribute('data-level'));
        selectMood(this, selectedMood, moodLevel);
    });
});

document.getElementById('modal-back').addEventListener('click', () => {
    const modal = document.getElementById('emotion-level-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');

    // Reset mood selection to original state
    if (selectedButton) {
        selectedButton.classList.remove('selected');
    }
    selectedMood = originalMood; // Reset mood to original
    selectedMoodLevel = moodLevel; // Default level
});

document.querySelectorAll('.level-btn').forEach(button => {
    button.addEventListener('click', () => {
        // Hapus seleksi level sebelumnya
        document.querySelectorAll('.level-btn').forEach(btn => {
            btn.classList.remove('bg-blue-500', 'text-white');
        });

        // Tandai level yang dipilih
        button.classList.add('bg-blue-500', 'text-white');
        selectedLevel = button.getAttribute('data-level');

        // Perbarui deskripsi level
        updateLevelDescription(selectedEmotion, selectedLevel);
    });
});

document.getElementById('modal-ok').addEventListener('click', () => {
    if (selectedLevel) {
        selectedMoodLevel = parseInt(selectedLevel); // Simpan level terpilih

        // Sembunyikan modal
        const modal = document.getElementById('emotion-level-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    } else {
        Swal.fire('Pilih Level', 'Anda harus memilih level sebelum melanjutkan.', 'warning');
    }
});


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

    console.log('Selected Mood Level:', selectedMoodLevel); // Debugging
    console.log('Selected Mood:', selectedMood);

    fetch(`/update-mood-note/${moodId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            mood_level: selectedMoodLevel, // Mood level yang dipilih
            mood_note: noteText
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire('Sukses!', 'Catatan berhasil disimpan!', 'success');

            // Perbarui UI dengan mood dan note terbaru
            document.getElementById('noteText').innerText = noteText;
            document.getElementById('moodEmoji').innerHTML = `<img src="${selectedMood}" alt="Mood Image" class="inline-block w-[100px] h-[100px] object-contain">`;

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
