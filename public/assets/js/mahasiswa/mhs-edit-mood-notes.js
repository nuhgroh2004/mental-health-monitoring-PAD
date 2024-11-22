let selectedMood = '{{ asset("asset/svg/emojiKecil/marah.svg") }}';
let selectedButton = null;
let originalMood = selectedMood;
let originalNoteText = '';
let selectedLevel = '3'; // Initial level for display only, not for modal
let selectedEmotion = 'Marah'; // Initial emotion for display only

// Initialize when document loads
document.addEventListener('DOMContentLoaded', function() {
    const levelButtons = document.querySelectorAll('.level-btn');
    const modalOkButton = document.getElementById('modal-ok');
    const modalBackButton = document.getElementById('modal-back');
    const modal = document.getElementById('emotion-level-modal');

    // Set initial emotion level description
    updateEmotionLevelDisplay();

    levelButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            levelButtons.forEach(b => b.classList.remove('bg-blue-500', 'text-white'));
            this.classList.add('bg-blue-500', 'text-white');
            selectedLevel = this.getAttribute('data-level');
            updateLevelDescription(selectedEmotion, selectedLevel);
        });
    });

    modalBackButton.addEventListener('click', function() {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        // Reset level buttons when going back
        levelButtons.forEach(btn => btn.classList.remove('bg-blue-500', 'text-white'));
        // Hide level description
        document.getElementById('level-description').classList.add('hidden');
    });

    modalOkButton.addEventListener('click', function() {
        if (selectedLevel) {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            updateEmotionLevelDisplay();
        } else {
            // Show alert if no level is selected
            Swal.fire({
                title: "Peringatan",
                text: "Silakan pilih level emosi terlebih dahulu!",
                icon: "warning",
                confirmButtonColor: "#3085d6"
            });
        }
    });
});

function showEmotionLevelModal() {
    const modal = document.getElementById('emotion-level-modal');
    document.getElementById('selected-emotion-text').textContent = selectedEmotion;

    // Reset level selection and description
    selectedLevel = null;
    const levelButtons = document.querySelectorAll('.level-btn');
    levelButtons.forEach(btn => btn.classList.remove('bg-blue-500', 'text-white'));

    // Hide level description until user selects a level
    document.getElementById('level-description').classList.add('hidden');
    document.getElementById('level-description-text').textContent = '';

    // Show modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function getLevelDescription(emotion, level) {
    const descriptions = {
        'Marah': {
            '1': "Saya merasa sedikit kesal",
            '2': "Saya merasa marah",
            '3': "Saya merasa sangat marah"
        },
        'Sedih': {
            '1': "Saya merasa sedikit sedih",
            '2': "Saya merasa sedih",
            '3': "Saya merasa sangat sedih"
        },
        'Biasa saja': {
            '1': "Saya merasa biasa saja",
            '2': "Saya merasa cukup biasa",
            '3': "Saya merasa benar-benar biasa"
        },
        'Senang': {
            '1': "Saya merasa sedikit senang",
            '2': "Saya merasa senang",
            '3': "Saya merasa sangat senang"
        }
    };

    return descriptions[emotion][level] || "";
}

function updateLevelDescription(emotion, level) {
    const levelDescriptionText = document.getElementById('level-description-text');
    const levelDescriptionDiv = document.getElementById('level-description');
    levelDescriptionDiv.classList.remove('hidden');
    levelDescriptionText.textContent = getLevelDescription(emotion, level);
}

function updateEmotionLevelDisplay() {
    let levelDisplay = document.getElementById('emotion-level-display');
    if (!levelDisplay) {
        levelDisplay = document.createElement('div');
        levelDisplay.id = 'emotion-level-display';
        levelDisplay.className = 'text-center mb-2 text-lg font-medium text-gray-700';
        const moodEmoji = document.getElementById('moodEmoji');
        moodEmoji.parentNode.insertBefore(levelDisplay, moodEmoji);
    }
    levelDisplay.textContent = getLevelDescription(selectedEmotion, selectedLevel);
}

function selectMood(button, mood) {
    if (selectedButton) {
        selectedButton.classList.remove('selected');
    }

    button.classList.add('selected');
    selectedMood = mood;
    selectedButton = button;

    // Determine emotion based on mood image
    if (mood.includes('marah')) {
        selectedEmotion = 'Marah';
    } else if (mood.includes('sedih')) {
        selectedEmotion = 'Sedih';
    } else if (mood.includes('biasaSaja')) {
        selectedEmotion = 'Biasa saja';
    } else if (mood.includes('senang')) {
        selectedEmotion = 'Senang';
    }

    showEmotionLevelModal();
}

function toggleEdit() {
    const editForm = document.getElementById('editForm');
    editForm.classList.toggle('hidden');

    if (!editForm.classList.contains('hidden')) {
        originalMood = document.querySelector('#moodEmoji img').src;
        originalNoteText = document.getElementById('noteText').innerText;
        selectedMood = originalMood;
        document.getElementById('noteInput').value = originalNoteText;
        editForm.scrollIntoView({ behavior: 'smooth' });
    }
}

function saveChanges() {
    const noteText = document.getElementById('noteInput').value;

    Swal.fire({
        title: "Apakah kamu yakin?",
        text: "Ingin menyimpan perubahan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya!",
        cancelButtonText: "Tidak!",
        customClass: {
            confirmButton: "btn btn-success w-24 mx-2",
            cancelButton: "btn btn-danger w-24 mx-2"
        }
    }).then((result) => {
        if (result.isConfirmed) {
            if (selectedMood !== originalMood || noteText !== originalNoteText) {
                document.querySelector('#moodEmoji img').src = selectedMood;
                document.getElementById('noteText').innerText = noteText;
                updateEmotionLevelDisplay();
            }

            Swal.fire({
                title: "Tersimpan!",
                text: "Perubahan berhasil disimpan.",
                icon: "success"
            });

            toggleEdit();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            selectedMood = originalMood;
            document.getElementById('noteInput').value = originalNoteText;
            toggleEdit();
        }
    });
}

function goBack() {
    window.location.href = "{{ route('mahasiswa.viewMoodCalendar') }}";
}
