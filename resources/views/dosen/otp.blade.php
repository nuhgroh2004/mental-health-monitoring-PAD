
<title>OTP Form</title>
<script src="https://cdn.tailwindcss.com"></script>

@vite('resources/css/app.css')
<body class="relative font-inter antialiased">

    <main class="relative min-h-screen flex flex-col justify-center bg-slate-50 overflow-hidden">
        <div class="w-full max-w-6xl mx-auto px-4 md:px-6 py-24">
            <div class="flex justify-center">

                <div class="max-w-md mx-auto text-center bg-white px-4 sm:px-8 py-10 rounded-xl shadow">
                    <header class="mb-8">
                        <h1 class="text-2xl font-bold mb-1">Email Verification</h1>
                        <p class="text-[15px] text-slate-500">Enter the 4-digit verification code that was sent to your email.</p>
                    </header>
                    <form id="otp-form">
                        <div class="flex items-center justify-center gap-3">
                            <input
                                type="text"
                                class="otp-input w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-[#76aeb8] focus:ring-2 focus:ring-[#b3e1e9]"
                                pattern="\d*" maxlength="1" />
                            <input
                                type="text"
                                class="otp-input w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-[#76aeb8] focus:ring-2 focus:ring-[#b3e1e9]"
                                maxlength="1" />
                            <input
                                type="text"
                                class="otp-input w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-[#76aeb8] focus:ring-2 focus:ring-[#b3e1e9]"
                                maxlength="1" />
                            <input
                                type="text"
                                class="otp-input w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-[#76aeb8] focus:ring-2 focus:ring-[#b3e1e9]"
                                maxlength="1" />
                        </div>

                        <div class="max-w-[260px] mx-auto mt-4">
                            <button type="submit" formaction="{{ route('dosen.landingPage') }}"
                                class="w-full inline-flex justify-center whitespace-nowrap rounded-lg bg-[#76aeb8] px-3.5 py-2.5 text-sm font-medium text-white shadow-sm shadow-indigo-950/10 hover:bg-[#36a0aa] focus:outline-none focus:ring focus:ring-[#b3e1e9] focus-visible:outline-none focus-visible:ring transition-colors duration-150">Verify
                                Email</button>
                        </div>
                    </form>
                    <div class="text-sm text-slate-500 mt-4">Didn't receive code? <a class="font-medium text-[#62989d] hover:text-[#36a0aa]" href="#0">Resend</a></div>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('.otp-input');
            inputs.forEach((input, index) => {
                input.addEventListener('input', function () {
                    if (input.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });
            });
        });

    </script>
    <script src="{{ asset('JS/script.js') }}"></script>
</body>


