<link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
@vite('resources/css/app.css')
<!-- resources/views/notes/create.blade.php -->
<body class="bg-[#76aeb8]">


<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md overflow-hidden h-auto">
        <form  class="p-8">
            {{-- @csrf --}}
            {{-- Tampilkan Tanggal dan Jam --}}
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
            </div>

            {{-- Catatan --}}
            <div class="mb-6">
                <label for="notes" class="block text-[#76aeb8] text-base font-bold mb-1">Catatan:</label>
                <textarea id="notes" name="notes" required
                          class="w-full px-4 py-2 border border-[#76aeb8] rounded-md focus:outline-none focus:ring-2 focus:ring-[#76aeb8] focus:border-[#76aeb8] resize-none text-base h-[200px]"></textarea>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-between">
                <a href="{{ route('mahasiswa.landingPage') }}" class="inline-flex items-center px-5 py-3 bg-[#76aeb8] hover:bg-[#3f9aaa] text-white rounded-md transition duration-300">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
                <a href="{{ route('mahasiswa.landingPage') }}" type="submit" class="inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition duration-300">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan
                </a>
            </div>
        </form>
    </div>
</div>
</body>
