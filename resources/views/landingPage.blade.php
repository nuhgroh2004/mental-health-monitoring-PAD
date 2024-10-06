@extends('navbar/navbar1')
@section('content')
<title>GamaPlus</title>

{{---------------------------------------------------------------- section pertama ----------------------------------------------------------------}}
<section class="bg-[#76aeb8] flex justify-center items-end">
    <div class="relative flex justify-center items-center w-full max-w-4xl ">
        <!-- Image Section -->
        <img src="{{ asset('asset/Gambar1.png') }}" alt="hero image" class="w-full h-full object-cover">

        <!-- Overlay Text: Judul besar untuk branding -->
        <h1 class="absolute top-10 text-5xl font-extrabold text-white px-4 leading-tight md:text-9xl" style="font-family: 'Irish Grover', cursive;">
            GamaPlus
        </h1>
    </div>
</section>
{{---------------------------------------------------------------- section pertama ----------------------------------------------------------------}}

{{---------------------------------------------------------------- section ke dua ----------------------------------------------------------------}}
<!-- Section ini digunakan untuk menampilkan berbagai fitur dashboard wellness -->
<section class="bg-[#e9f5f9] py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Judul Section -->
        <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">Fitur Fitur</h2>

        <!-- Kontainer Grid untuk fitur-fitur -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Mood Tracker -->
            <div class="bg-white p-6 rounded-lg shadow-md opacity-0 transform translate-y-4 transition-all duration-500" data-animate>
                <!-- Judul Fitur -->
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Mood Tracker</h3>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">How are you feeling today?</h3>

                <!-- Tombol Emoji -->
                <div class="flex justify-around">
                    <button class="text-4xl hover:transform hover:scale-110 transition-transform">😠</button>
                    <button class="text-4xl hover:transform hover:scale-110 transition-transform">😢</button>
                    <button class="text-4xl hover:transform hover:scale-110 transition-transform">😐</button>
                    <button class="text-4xl hover:transform hover:scale-110 transition-transform">😊</button>
                    <button class="text-4xl hover:transform hover:scale-110 transition-transform">😍</button>
                </div>

                <!-- Deskripsi Fitur -->
                <p class="text-gray-600 mb-4 text-center mt-10">
                    Pilih emosi yang paling menggambarkan perasaan Anda hari ini. Dengan melacak suasana hati setiap hari,
                    Anda dapat meningkatkan kesadaran diri dan kesejahteraan emosional.
                </p>
            </div>

            <!-- Set Your Goals -->
            <div class="bg-white p-6 rounded-lg shadow-md opacity-0 transform translate-y-4 transition-all duration-500" data-animate>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Set Your Goals</h3>

                <!-- Timer yang menunjukkan waktu untuk mengatur tujuan -->
                <div class="bg-white p-6 rounded-lg shadow-inner mb-6">
                    <div class="text-4xl font-bold text-center" id="timer">
                        <div class="text-gray-300"><span id="prev-minutes">03</span>:<span id="prev-seconds">29</span></div>
                        <div class="text-black"><span id="current-minutes">04</span>:<span id="current-seconds">30</span></div>
                        <div class="text-gray-300"><span id="next-minutes">05</span>:<span id="next-seconds">31</span></div>
                    </div>
                </div>

                <!-- Tombol Start dan Submit -->
                <div class="flex justify-center space-x-4">
                    <button id="startBtn" onclick="startTimer()" class="bg-green-500 text-white px-6 py-2 rounded-full transition duration-300">START</button>
                </div>
                <div class="mt-6">
                    <button onclick="submitGoal()" class="mt-2 bg-purple-500 text-white px-4 py-2 rounded-md transition duration-300">Submit</button>
                </div>
            </div>

            <!-- Mood Calendar -->
            <div class="bg-white p-6 rounded-lg shadow-md opacity-0 transform translate-y-4 transition-all duration-500" data-animate>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">View Mood Calendar</h3>
                <div class="text-center mb-2">&lt;November 2024&gt;</div>

                <!-- Kalender untuk melacak mood berdasarkan tanggal -->
                <div class="grid grid-cols-7 gap-2">
                    @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                        <div class="text-center font-semibold">{{ $day }}</div>
                    @endforeach
                    @for ($i = 1; $i <= 35; $i++)
                        <div class="aspect-square bg-gray-100 rounded-md flex flex-col items-center justify-center {{ $i <= 30 ? 'cursor-pointer hover:bg-gray-200' : 'text-gray-400' }}">
                            @if ($i <= 30)
                                <span class="text-xl mb-1">{{ ['😍', '😊', '😐', '😢', '😠'][rand(0, 4)] }}</span>
                                <span class="text-sm">{{ $i }}</span>
                            @endif
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Journaling -->
            <div class="bg-white p-6 rounded-lg shadow-md opacity-0 transform translate-y-4 transition-all duration-500" data-animate>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Create Notes</h3>

                <!-- Input Tanggal dan Waktu -->
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center">
                        <span class="mr-2">📅</span>
                        <input type="date" class="border rounded px-2 py-1" value="{{ date('Y-m-d') }}" readonly>
                    </div>
                    <div class="flex items-center">
                        <span class="mr-2">🕒</span>
                        <input type="time" class="border rounded px-2 py-1" value="{{ date('H:i') }}" readonly>
                    </div>
                    <span class="text-4xl">😊</span>
                </div>

                <!-- Area untuk menulis jurnal harian -->
                <textarea class="w-full h-32 p-2 border rounded resize-none" placeholder="Write your thoughts here..." readonly></textarea>
                <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save Entry</button>
            </div>

            <!-- Progress Tracker Tugas Akhir -->
            <div class="bg-white p-6 rounded-lg shadow-md opacity-0 transform translate-y-4 transition-all duration-500" data-animate>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Report Tracker Pengerjan Tugas Akhir</h3>
                <div class="h-64 flex items-end justify-between">
                    @for ($i = 0; $i < 7; $i++)
                        <div class="w-8 bg-green-500 rounded-t-md" style="height: {{ rand(20, 100) }}%"></div>
                    @endfor
                </div>
                <div class="mt-2 flex justify-between text-sm text-gray-600">
                    <span>Mon</span>
                    <span>Tue</span>
                    <span>Wed</span>
                    <span>Thu</span>
                    <span>Fri</span>
                    <span>Sat</span>
                    <span>Sun</span>
                </div>
            </div>

            <!-- Report Tracker Mood -->
            <div class="bg-white p-6 rounded-lg shadow-md opacity-0 transform translate-y-4 transition-all duration-500" data-animate>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Report Tracker Mood</h3>
                <div class="h-64 flex items-end justify-between">
                    @for ($i = 0; $i < 7; $i++)
                        <div class="w-8 bg-green-500 rounded-t-md" style="height: {{ rand(20, 100) }}%"></div>
                    @endfor
                </div>
                <div class="mt-2 flex justify-between text-sm text-gray-600">
                    <span>😠</span>
                    <span>😢</span>
                    <span>😐</span>
                    <span>😊</span>
                    <span>😍</span>
                    <span>😍</span>
                    <span>😍</span>
                </div>
            </div>
        </div>
    </div>
</section>
{{---------------------------------------------------------------- section ke dua ----------------------------------------------------------------}}

@endsection
