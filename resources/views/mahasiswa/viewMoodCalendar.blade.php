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
<title>View mood calender</title>
<section>
<div class="container mx-auto px-4 py-8">
    <div class="bg-blue-100 rounded-lg shadow-md p-6">
        <div class="flex items-center justify-center mb-4">
            <button id="prevMonth" class="text-xl sm:text-2xl font-bold px-2 sm:px-4 py-1 sm:py-2 rounded-full hover:bg-blue-200 transition-colors duration-300">&lt;</button>
            <h2 id="currentMonth" class="text-xl sm:text-2xl font-bold mx-2 sm:mx-4">November 2024</h2>
            <button id="nextMonth" class="text-xl sm:text-2xl font-bold px-2 sm:px-4 py-1 sm:py-2 rounded-full hover:bg-blue-200 transition-colors duration-300">&gt;</button>
        </div>
        <div id="calendarGrid" class="grid grid-cols-7 gap-2">
            @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
            <div class="text-center font-semibold">{{ $day }}</div>
            @endforeach

            @php
            $moodSvgs = [
            'happy' => asset('asset/svg/emojiKecil/senang.svg'),
            'sad' => asset('asset/svg/emojiKecil/sedih.svg'),
            'angry' => asset('asset/svg/emojiKecil/marah.svg'),
            'neutral' => asset('asset/svg/emojiKecil/biasaSaja.svg'),
            ];

            // Contoh data mood (ganti dengan data sebenarnya dari database)
            $moods = [
            1 => 'happy',
            2 => 'happy',
            3 => 'happy',
            4 => 'sad',
            5 => 'happy',
            6 => 'happy',
            7 => 'happy',
            8 => 'sad',
            9 => 'angry',
            10 => 'neutral',
            11 => 'neutral',
            12 => 'neutral',
            // ... tambahkan mood untuk hari lainnya
            ];
            @endphp

            @for ($i = 1; $i <= 35; $i++)
            <a href="{{ route('mahasiswa.editMoodDanNotes') }}"
            class="aspect-square bg-white rounded-lg shadow hover:shadow-md transition-shadow duration-300 flex flex-col items-center justify-center p-1"
            onclick="showMoodDetails({{ $i }})"
            >
            <span class="text-sm mb-1">{{ $i }}</span>
            <div class="w-4 h-4 sm:w-6 sm:h-6" title="{{ isset($moods[$i]) ? ucfirst($moods[$i]) : '' }}">
            @if(isset($moods[$i]))
            <img src="{{ $moodSvgs[$moods[$i]] }}" alt="{{ $moods[$i] }} mood" class="w-full h-full">
            @endif
            </div>
            </a>
            @endfor
        </div>
    </div>
</div>
</section>

<script>
const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
let currentDate = new Date(2024, 10, 1); // November 2024

function updateCalendar() {
    const monthYear = `${months[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
    document.getElementById('currentMonth').textContent = monthYear;

    // Here you would typically fetch new mood data for the selected month
    // and update the calendar grid
    console.log(`Fetching mood data for ${monthYear}`);
    // updateCalendarGrid(newMoodData);
}

document.getElementById('prevMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    updateCalendar();
});

document.getElementById('nextMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    updateCalendar();
});

function showMoodDetails(day) {
    console.log(`Show mood details for day ${day}`);
    // Implementasi untuk menampilkan detail mood atau navigasi ke halaman detail
}

// Initial calendar setup
updateCalendar();
</script>
@endsection

