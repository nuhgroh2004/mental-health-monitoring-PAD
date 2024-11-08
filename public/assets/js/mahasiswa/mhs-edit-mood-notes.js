let selectedMood = '{{ asset("asset/svg/emojiKecil/marah.svg") }}';
let selectedButton = null;

function toggleEdit() {
    const editForm = document.getElementById('editForm');
    editForm.classList.toggle('hidden');

    if (!editForm.classList.contains('hidden')) {
        selectedMood = document.getElementById('moodEmoji').innerText;
        document.getElementById('noteInput').value = document.getElementById('noteText').innerText;
    }
}

function selectMood(button, mood) {

    if (selectedButton) {
        selectedButton.classList.remove('selected');
    }


    button.classList.add('selected');


    selectedMood = mood;
    selectedButton = button;
}

function saveChanges() {
    const noteText = document.getElementById('noteInput').value;


    document.querySelector('#moodEmoji img').src = selectedMood;
    document.getElementById('noteText').innerText = noteText;


    toggleEdit();
}

function goBack() {
    window.location.href = "{{ route('mahasiswa.viewMoodCalendar') }}";
}
