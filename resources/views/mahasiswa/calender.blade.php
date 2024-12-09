@extends('navbar/navbar-mahasiswa')
@section('content')

<title>View mood calender</title>
<section>
    <div class="container mx-auto px-4 py-8">
        <div class="containe-calender bg-blue-100 rounded-lg shadow-md p-6">
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
                <a href="{{ route('mahasiswa.edit-mood-notes') }}"
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

@endsection

