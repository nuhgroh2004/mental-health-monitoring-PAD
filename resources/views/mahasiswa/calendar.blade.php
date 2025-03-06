<!-- filepath: /c:/mental-health-monitoring-PAD/resources/views/mahasiswa/calendar.blade.php -->
@extends('navbar/navbar-mahasiswa')
@section('content')

<title>View mood calender</title>
<section>
    <div class="container mx-auto px-4 py-8">
        <div class="containe-calender bg-blue-100 rounded-lg shadow-md p-6">
            <div class="flex items-center justify-center mb-4">
                <button id="prevMonth" class="text-xl sm:text-2xl font-bold px-2 sm:px-4 py-1 sm:py-2 rounded-full hover:bg-blue-200 transition-colors duration-300">&lt;</button>
                <h2 id="currentMonth" class="text-xl sm:text-2xl font-bold mx-2 sm:mx-4">{{ $monthName }} {{ $year }}</h2>
                <button id="nextMonth" class="text-xl sm:text-2xl font-bold px-2 sm:px-4 py-1 sm:py-2 rounded-full hover:bg-blue-200 transition-colors duration-300">&gt;</button>
            </div>
            <div id="calendarGrid" class="grid grid-cols-7 gap-2">
                @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                <div class="text-center font-semibold">{{ $day }}</div>
                @endforeach

                @php
                $moodSvgs = [
                    '1' => asset('asset/svg/emojiKecil/marah.svg'),
                    '2' => asset('asset/svg/emojiKecil/sedih.svg'),
                    '3' => asset('asset/svg/emojiKecil/biasaSaja.svg'),
                    '4' => asset('asset/svg/emojiKecil/senang.svg'),
                ];
                @endphp

                @for ($i = 1; $i <= 42; $i++) <!-- Mungkin sampai 42 karena beberapa bulan punya 6 minggu -->
                    @if ($i <= $firstDayOfWeek || $i > $daysInMonth + $firstDayOfWeek)
                        <div class="bg-gray-100"></div> <!-- Tempatkan elemen kosong -->
                    @else
                        @php
                            $day = $i - $firstDayOfWeek; // Menghitung tanggal hari
                            $currentDate = \Carbon\Carbon::create($year, $month, $day);
                            $today = \Carbon\Carbon::today();
                            $isFuture = $currentDate->greaterThan($today); // Periksa apakah tanggal lebih besar dari hari ini
                            $mood = $moodByDay[$day] ?? null;
                        @endphp
                        @if ($isFuture)
                            <!-- Hari setelah hari ini tidak bisa diklik -->
                            <div class="aspect-square bg-gray-200 rounded-lg shadow-inner flex flex-col items-center justify-center p-1 opacity-50">
                                <span class="text-sm mb-1">{{ $day }}</span>
                                <div class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10">
        
                                </div>
                            </div>
                        @else
                            <!-- Hari yang bisa diklik -->
                            <a href="{{ route('mahasiswa.edit-mood-notes', ['day' => $day, 'month' => $month, 'year' => $year, 'user_id' => auth()->id() ])}}"
                                class="aspect-square bg-white rounded-lg shadow hover:shadow-md transition-shadow duration-300 flex flex-col items-center justify-center p-1">
                                <span class="text-sm mb-1">{{ $day }}</span>
                                <div class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10 flex items-center justify-center" title="{{ $mood ? ucfirst($mood->mood_level) : '' }}">
                                    @if(isset($mood->mood_level) && isset($moodSvgs[$mood->mood_level]))
                                        <img src="{{ $moodSvgs[$mood->mood_level] }}" alt="{{ $mood->mood_level }} mood" class="w-full h-full object-contain">
                                    @else
                                        <span class="text-gray-400 text-xs sm:text-sm flex items-center justify-center w-full h-full text-center">Tidak Mengisi</span>
                                    @endif
                                </div>
                            </a>
                        @endif
                    @endif
                @endfor
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        let currentMonth = {{ $month }}; // Bulan saat ini (dari server)
        let currentYear = {{ $year }};  // Tahun saat ini (dari server)

        // Fungsi untuk memperbarui URL
        function updateUrl(newMonth, newYear) {
            const baseUrl = "{{ url('mahasiswa/calendar') }}"; // URL dasar ke calendar
            const newUrl = `${baseUrl}?month=${newMonth}&year=${newYear}`;
            window.location.href = newUrl; // Redirect ke URL baru
        }

        // Event Listener untuk tombol Previous
        document.getElementById('prevMonth').addEventListener('click', () => {
            currentMonth--; // Kurangi 1 bulan
            if (currentMonth < 1) { // Jika bulan < 1, kembali ke Desember tahun sebelumnya
                currentMonth = 12;
                currentYear--;
            }
            updateUrl(currentMonth, currentYear); // Redirect dengan bulan dan tahun yang baru
        });

        // Event Listener untuk tombol Next
        document.getElementById('nextMonth').addEventListener('click', () => {
            currentMonth++; // Tambahkan 1 bulan
            if (currentMonth > 12) { // Jika bulan > 12, pindah ke Januari tahun berikutnya
                currentMonth = 1;
                currentYear++;
            }
            updateUrl(currentMonth, currentYear); // Redirect dengan bulan dan tahun yang baru
        });
    });
</script>

@endsection