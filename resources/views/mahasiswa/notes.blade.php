<link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
@vite('resources/css/app.css')
<!-- resources/views/notes/create.blade.php -->

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

<body>


<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden h-auto sm:max-w-full">
            <form action="{{ route('mahasiswa.storeMood') }}" method="POST" class="p-8">
                @csrf
                <!-- Hidden inputs untuk menyimpan emotion dan intensity -->
                <input type="hidden" id="selectedEmotion" name="selectedEmotion">
                <input type="hidden" id="selectedIntensity" name="selectedIntensity">

                <!-- Display emoji dan intensitas yang dipilih -->
                <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[#76aeb8] text-base font-bold mb-1">Tanggal:</label>
                        <div class="bg-gray-100 px-4 py-2 rounded-md text-base">
                            {{ now()->format('d/m/Y') }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-[#76aeb8] text-base font-bold mb-1">Jam:</label>
                        <div class="bg-gray-100 px-4 py-2 rounded-md text-base">
                            {{ now()->format('H:i') }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-[#76aeb8] text-base font-bold mb-1">Perasaan yang dipilih:</label>
                        <div id="emotion-display" class="bg-gray-100 px-4 py-2 rounded-md text-base"></div>
                    </div>
                    <div>
                        <label class="block text-[#76aeb8] text-base font-bold mb-1">Intensitas:</label>
                        <div id="intensity-display" class="bg-gray-100 px-4 py-2 rounded-md text-base"></div>
                    </div>

                </div>

                <!-- Catatan -->
                <div class="mb-6">
                    <label for="notes" class="block text-[#76aeb8] text-base font-bold mb-1">Catatan:</label>
                    <textarea id="notes" name="notes" required
                              class="w-full px-4 py-2 border border-[#76aeb8] rounded-md focus:outline-none focus:ring-2 focus:ring-[#76aeb8] focus:border-[#76aeb8] resize-none text-base h-[200px]"></textarea>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-between">
                    <a href="{{ route('mahasiswa.home') }}" class="inline-flex items-center px-3 py-2 sm:px-5 sm:py-3 bg-[#76aeb8] hover:bg-[#3f9aaa] text-white rounded-md transition duration-300">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    <button type="submit" class="inline-flex items-center px-3 py-2 sm:px-5 sm:py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition duration-300">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
    </div>
</div>


<script>
    // Ambil nilai emot dan intensitas dari sessionStorage saat halaman dimuat
    window.onload = () => {
        const selectedEmotion = sessionStorage.getItem('selectedEmotion');
        const selectedIntensity = sessionStorage.getItem('selectedIntensity');

        if (selectedEmotion && selectedIntensity) {
            // Tampilkan nilai di form
            document.getElementById('emotion-display').textContent = selectedEmotion;
            document.getElementById('intensity-display').textContent = selectedIntensity;

            // Set nilai di hidden inputs
            document.getElementById('selectedEmotion').value = selectedEmotion;
            document.getElementById('selectedIntensity').value = selectedIntensity;
        } else {
            // Redirect kembali ke home jika tidak ada data
            window.location.href = "{{ route('mahasiswa.home') }}";
        }
    }
</script>

</body>
