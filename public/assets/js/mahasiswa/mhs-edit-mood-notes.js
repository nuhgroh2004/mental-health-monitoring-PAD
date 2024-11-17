let selectedMood = '{{ asset("asset/svg/emojiKecil/marah.svg") }}';
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

function selectMood(button, mood) {
    if (selectedButton) {
        selectedButton.classList.remove('selected');
    }

    button.classList.add('selected');

    // Set mood yang dipilih
    selectedMood = mood;
    selectedButton = button;
}

function saveChanges() {
    const noteText = document.getElementById('noteInput').value;

    // Tampilkan pesan konfirmasi sebelum menyimpan perubahan
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
            // Cek apakah ada perubahan pada mood atau catatan
            if (selectedMood !== originalMood || noteText !== originalNoteText) {
                document.querySelector('#moodEmoji img').src = selectedMood;
                document.getElementById('noteText').innerText = noteText;
            }

            // Tampilkan pesan sukses setelah menyimpan perubahan
            Swal.fire({
                title: "Tersimpan!",
                text: "Perubahan berhasil disimpan.",
                icon: "success"
            });

            // Tutup form edit
            toggleEdit();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Jika user membatalkan, kembalikan data ke kondisi awal
            selectedMood = originalMood;
            document.getElementById('noteInput').value = originalNoteText;

            // Tutup form edit tanpa menyimpan perubahan
            toggleEdit();
        }
    });
}

function goBack() {
    window.location.href = "{{ route('mahasiswa.viewMoodCalendar') }}";
}
