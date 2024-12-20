
<title>OTP Form</title>
<link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
<script src="https://cdn.tailwindcss.com"></script>

@vite('resources/css/app.css')
<body class="relative font-inter antialiased">

    <main class="relative min-h-screen flex flex-col justify-center bg-slate-50 overflow-hidden">
        <div class="w-full max-w-6xl mx-auto px-4 md:px-6 py-24">
            <div class="flex justify-center">

                <div class="max-w-md mx-auto text-center bg-white px-4 sm:px-8 py-10 rounded-xl shadow">
                    <header class="mb-8">
                        <h1 class="text-2xl font-bold mb-1">Verifikasi Email</h1>
                        <p class="text-[15px] text-slate-500">Masukkan kode OTP yang dikirimkan ke email Anda.</p>
                    </header>
                    <form id="otp-form" method="POST" action="{{ route('verify-otp') }}">
                        @csrf
                        <input type="hidden" name="dosen_id" value="{{ $dosenId }}">
                        <div class="flex items-center justify-center gap-3">
                            @for ($i = 0; $i < 4; $i++)
                                <input
                                type="text"
                                name="otp_code[]"
                                class="otp-input w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-[#76aeb8] focus:ring-2 focus:ring-[#b3e1e9]"
                                maxlength="1"
                                inputmode="numeric"
                                pattern="\d*"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                    />
                            @endfor
                        </div>

                        @if ($errors->has('otp'))
                            <div class="text-red-500 text-sm mt-2">
                                {{ $errors->first('otp') }}
                            </div>
                        @endif

                        <div class="max-w-[260px] mx-auto mt-4">
                            <button type="submit"
                                class="w-full inline-flex justify-center whitespace-nowrap rounded-lg bg-[#76aeb8] px-3.5 py-2.5 text-sm font-medium text-white shadow-sm shadow-indigo-950/10 hover:bg-[#36a0aa] focus:outline-none focus:ring focus:ring-[#b3e1e9] focus-visible:outline-none focus-visible:ring transition-colors duration-150">Verify
                                Email</button>
                        </div>
                    </form>

                <!-- Tombol Kirim Ulang -->
                <div class="text-sm text-slate-500 mt-4">
                    Tidak menerima kode?
                    <form id="resendOtpForm" action="{{ route('resend-otp') }}" method="POST">
                        @csrf
                        <button type="submit" id="resendOtp" class="font-medium text-[#62989d] hover:text-[#36a0aa]">
                            Kirim ulang
                        </button>
                    </form>
                    <div id="timer" class="text-lg text-slate-500 mt-2">{{ sprintf('%02d:%02d', floor($remainingTime / 60), $remainingTime % 60) }}</div>
                </div>

            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get timer element
            const timerElement = document.getElementById('timer');
            const resendButton = document.getElementById('resendOtp');

            // Initial remaining time from server (in seconds)
            let timeLeft = {{ $remainingTime }};

            // Countdown function
            function updateTimer() {
                // Calculate minutes and seconds
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;

                // Format time with leading zeros
                const formattedTime = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                // Update timer display
                timerElement.textContent = formattedTime;

                // Check if time is up
                if (timeLeft <= 0) {
                    timerElement.textContent = '00:00';
                    resendButton.disabled = false;
                    return;
                }

                // Decrement time
                timeLeft--;
            }

            // Start the countdown immediately
            updateTimer();

            // Update timer every second
            const timerInterval = setInterval(updateTimer, 1000);

            // Optional: Clear interval if page is closed/navigated away
            window.addEventListener('beforeunload', () => {
                clearInterval(timerInterval);
            });
        });


        // Fungsi untuk memperbesar ukuran font timer
        function increaseFontSize() {
            timerElement.style.fontSize = '2rem'; // Atur ukuran font sesuai kebutuhan
        }

        // Panggil fungsi untuk memperbesar ukuran font saat halaman dimuat
        document.addEventListener('DOMContentLoaded', increaseFontSize);
    </script>
    <script src="{{ asset('JS/script.js') }}"></script>
</body>


