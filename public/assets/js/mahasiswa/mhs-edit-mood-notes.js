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

    button.classList.add('selected');

    // Set mood yang dipilih
    selectedMood = mood;
    selectedMoodLevel = moodLevel; // Set mood level yang sesuai
    selectedButton = button;
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
