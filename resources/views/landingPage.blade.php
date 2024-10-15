@extends('navbar/navbar1')
@section('content')
<title>GamaPlus</title>

<section class="bagian1 bg-[#76aeb8] flex justify-center items-end">
    <div class="relative flex justify-center items-center w-full max-w-4xl">
        <!-- Image Section -->
        <img src="{{ asset('asset/Gambar1.png') }}" alt="hero image" class="w-full h-full object-cover" loading="lazy">
        <!-- Overlay Text: Judul besar untuk branding -->
        <h1 class="absolute top-10 text-5xl font-extrabold text-white px-4 leading-tight md:text-9xl animate-float" style="font-family: 'Irish Grover', cursive;">
            GamaPelus
        </h1>
        <!-- Buttons Container -->
        <div class="absolute inset-x-0 bottom-1/3 flex justify-center space-x-16">
            <!-- Login Button -->
            <a href="{{ route('login') }}" class="px-4 py-2 w-auto bg-white text-[#76aeb8] rounded-full font-bold text-base transform hover:scale-110 transition duration-300 ease-in-out animate-bounce-slow md:px-8 md:py-4 md:text-xl">
                Login
            </a>
            <!-- Register Dropdown -->
            <div class="relative group">
                <button class="px-4 py-2 bg-[#ff9800] text-white rounded-full font-bold text-base transform hover:scale-110 transition duration-300 ease-in-out animate-bounce-slow md:px-8 md:py-4 md:text-xl">
                    Register
                </button>
                <div class="absolute p-3 left-1/2 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 opacity-0 group-hover:opacity-100 transition duration-300 ease-in-out transform group-hover:translate-y-0 translate-y-2 -translate-x-1/2">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <a href="{{ route('mahasiswa.register') }}" class="block px-4 py-2 text-sm text-[#ff9800] hover:bg-[#ff9800] hover:text-white rounded" role="menuitem">Mahasiswa</a>
                        <a href="{{ route('dosen.register') }}" class="block px-4 py-2 text-sm text-[#ff9800] hover:bg-[#ff9800] hover:text-white rounded" role="menuitem">Dosen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{---------------------------------------------------------------- section pertama ----------------------------------------------------------------}}

{{---------------------------------------------------------------- section ke dua ----------------------------------------------------------------}}
<section class="bagian2 bg-[#e9f5f9] min-h-screen flex justify-center items-center p-4 sm:p-6 md:p-8">
    <div class="w-full max-w-6xl mx-auto">
        <div class="flex flex-col-reverse lg:flex-row justify-between items-center">
            <!-- Text Section -->
            <div class="w-full lg:w-1/2">
                <div class="space-y-4 text-[#247786] text-justify">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 text-center lg:text-left">Pemantauan Kesehatan Mental</h2>
                    <p class="text-base sm:text-lg">Platform kami membantu Anda melacak kesehatan mental dan kesejahteraan Anda melalui berbagai fitur seperti pelacakan suasana hati, penetapan tujuan, dan penulisan jurnal.</p>
                    <p class="text-base sm:text-lg">Tetap pantau kesehatan mental Anda dengan alat kami yang mudah digunakan, dirancang untuk memberikan wawasan dan dukungan bagi kesejahteraan emosional Anda.</p>
                    <p class="text-base sm:text-lg">Bergabunglah dengan kami dalam mempromosikan kesadaran kesehatan mental dan ambil langkah pertama menuju Anda yang lebih sehat dan bahagia.</p>
                </div>
            </div>

            <!-- Image Section -->
            <div class="w-full lg:w-1/2 mt-8 lg:mt-0">
                <img src="{{ asset('asset/Gambar2.png') }}" alt="hero image" class="w-full h-auto object-cover"  loading="lazy">
            </div>
        </div>
    </div>
</section>

{{---------------------------------------------------------------- section ke dua ----------------------------------------------------------------}}

{{---------------------------------------------------------------- section ke tiga ----------------------------------------------------------------}}
<section class="bagian3 bg-[#76aeb8] flex justify-center items-center min-h-screen p-4 sm:p-6 md:p-8">
    <div class="flex flex-col lg:flex-row w-full max-w-6xl justify-between items-center px-4 sm:px-6 md:px-8">
        <!-- Image Section -->
        <div class="w-full lg:w-1/2 order-1 lg:order-1">
            <img src="{{ asset('asset/Gambar3.png') }}" alt="hero image" class="w-full h-auto object-cover rounded-lg"  loading="lazy">
        </div>
        <!-- Text Section -->
        <div class="w-full lg:w-1/2 order-2 lg:order-2 mt-8 lg:mt-0">
            <div class="space-y-4 text-white">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 text-center lg:text-left">Pemantauan Kesehatan Mental</h2>
                <p class="text-base sm:text-lg text-justify">Platform kami membantu Anda melacak kesehatan mental dan kesejahteraan Anda melalui berbagai fitur seperti pelacakan suasana hati, penetapan tujuan, dan penulisan jurnal.</p>
                <p class="text-base sm:text-lg text-justify">Tetap pantau kesehatan mental Anda dengan alat kami yang mudah digunakan, dirancang untuk memberikan wawasan dan dukungan bagi kesejahteraan emosional Anda.</p>
                <p class="text-base sm:text-lg text-justify">Bergabunglah dengan kami dalam mempromosikan kesadaran kesehatan mental dan ambil langkah pertama menuju Anda yang lebih sehat dan bahagia.</p>
            </div>
        </div>
    </div>
</section>
{{---------------------------------------------------------------- section ke tiga ----------------------------------------------------------------}}

{{---------------------------------------------------------------- section ke empat ----------------------------------------------------------------}}
<!-- Section ini digunakan untuk menampilkan berbagai fitur dashboard wellness -->
<section class="bagian4 bg-[#e9f5f9] py-16">
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
{{---------------------------------------------------------------- section ke empat ----------------------------------------------------------------}}

{{---------------------------------------------------------------- section ke lima ----------------------------------------------------------------}}
<section class="bagaina5 bg-[#76aeb8] min-h-screen flex justify-center items-center p-4 sm:p-6 md:p-8">
    <div class="w-full max-w-6xl mx-auto">
        <div class="flex flex-col-reverse lg:flex-row justify-between items-center gap-5">
            <!-- Text Section -->
            <div class="w-full lg:w-1/2">
                <div class="space-y-4 text-white text-justify">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 text-center lg:text-left">Daftar Sekarang</h2>
                    <p class="text-base sm:text-lg">Bergabunglah dengan platform kami untuk melacak kesehatan mental dan kesejahteraan Anda melalui berbagai fitur seperti pelacakan suasana hati, penetapan tujuan, dan penulisan jurnal.</p>
                    <p class="text-base sm:text-lg">Daftar sekarang dan pantau kesehatan mental Anda dengan alat kami yang mudah digunakan, dirancang untuk memberikan wawasan dan dukungan bagi kesejahteraan emosional Anda.</p>
                    <p class="text-base sm:text-lg">Ambil langkah pertama menuju Anda yang lebih sehat dan bahagia dengan mendaftar di platform kami hari ini.</p>
                </div>
            </div>

            <!-- Image Section -->
            <div class="w-full lg:w-1/2 mt-8 lg:mt-0">
                <img src="{{ asset('asset/Gambar4.png') }}" alt="hero image" class="w-full h-auto object-cover rounded-lg"  loading="lazy">
            </div>
        </div>
    </div>
</section>
{{---------------------------------------------------------------- section ke lima ----------------------------------------------------------------}}

{{---------------------------------------------------------------- footer ----------------------------------------------------------------}}
<footer class="bg-[#247786] text-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between">
            <!-- Logo and Description -->
            <div class="w-full md:w-1/4 mb-6 md:mb-0">
                <h2 class="text-2xl font-bold mb-4">Mental Health</h2>
                <p class="text-white">Mendukung kesehatan mental Anda setiap hari.</p>
            </div>

            <!-- Contact Info -->
            <div class="w-full md:w-1/4 mb-6 md:mb-0">
                <h3 class="text-lg font-semibold mb-4">Hubungi Kami</h3>
                <p class="mb-2">Email: info@mentalhealthapp.com</p>
                <p class="mb-2">Phone: (123) 456-7890</p>
                <p>Alamat: Jl. Sehat Jiwa No. 123, Jakarta</p>
            </div>

            <!-- Social Media -->
            <div class="w-full md:w-1/4">
                <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>
                <div class="flex space-x-4">
                    <!-- Facebook -->
                    <a href="#" class="hover:text-blue-400 transition duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                        </svg>
                    </a>
                    <!-- Twitter -->
                    <a href="#" class="hover:text-blue-400 transition duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="#" class="hover:text-blue-400 transition duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 pt-8 border-t border-white text-center">
            <p>&copy; 2023 Mental Health App. All rights reserved.</p>
        </div>
    </div>
</footer>
{{---------------------------------------------------------------- footer ----------------------------------------------------------------}}
@endsection

