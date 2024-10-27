@extends('navbar/navbar2')
@section('content')
<title>Notifikasi</title>
<body class="bg-gray-100">
    <div class="min-h-screen p-8">
        <h1 class="text-3xl font-bold text-black mb-6">Notifikasi</h1>

        <!-- Tab Navigation -->
        @php
            $pendingCount = 1; // Replace with actual count
            $approvedCount = 2; // Replace with actual count
            $rejectedCount = 1; // Replace with actual count
        @endphp

        <div class="mb-6 flex border-b">
            <button class="tab-btn px-6 py-2 text-black font-medium border-b-2 border-black" data-tab="pending">
                Menunggu
                <span class="ml-1 bg-red-500 text-white rounded-full px-2 py-0.5 text-xs">{{ $pendingCount }}</span>
            </button>
            <button class="tab-btn px-6 py-2 text-black font-medium opacity-70 border-black" data-tab="approved">
                Disetujui
                <span class="ml-1 bg-red-500 text-white rounded-full px-2 py-0.5 text-xs">{{ $approvedCount }}</span>
            </button>
            <button class="tab-btn px-6 py-2 text-black font-medium opacity-70 border-black" data-tab="rejected">
                Ditolak
                <span class="ml-1 bg-red-500 text-white rounded-full px-2 py-0.5 text-xs">{{ $rejectedCount }}</span>
            </button>
        </div>

        <!-- Menunggu Content -->
        <div id="pending-content" class="tab-content space-y-4">
            <div class="bg-yellow-100 rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-yellow-800">Permintaan Persetujuan</h2>
                    <p class="text-yellow-700">Permintaan izin Anda sedang menunggu persetujuan.</p>
                    <div class="mt-2">
                        <p class="text-sm text-yellow-600">
                            <span>Nama</span>
                            <span>:</span>
                            <span>Mamang jon</span>
                        </p>
                        <p class="text-sm text-yellow-600">
                            <span>NIM</span>
                            <span class="ml-[11px]">:</span>
                            <span>123456789</span>
                        </p>
                    </div>
                    <p class="text-sm text-yellow-500 mt-2">{{ now()->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Disetujui Content -->
        <div id="approved-content" class="tab-content space-y-4 hidden">
            <div class="bg-green-100 rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-green-800">Izin Disetujui</h2>
                    <p class="text-green-700">Permintaan izin Anda telah disetujui.</p>
                    <div class="mt-2">
                        <p class="text-sm text-green-600">
                            <span>Nama</span>
                            <span>:</span>
                            <span>Mamang saep</span>
                        </p>
                        <p class="text-sm text-green-600">
                            <span>NIM</span>
                            <span class="ml-[11px]">:</span>
                            <span>123456789</span>
                        </p>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <p class="text-sm text-green-500">{{ now()->format('d M Y H:i') }}</p>
                        <a href="#" class="text-blue-500 hover:text-blue-700 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-green-100 rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-green-800">Izin Disetujui</h2>
                    <p class="text-green-700">Permintaan izin Anda telah disetujui.</p>
                    <div class="mt-2">
                        <p class="text-sm text-green-600">
                            <span>Nama</span>
                            <span>:</span>
                            <span>Mamang saep</span>
                        </p>
                        <p class="text-sm text-green-600">
                            <span>NIM</span>
                            <span class="ml-[11px]">:</span>
                            <span>123456789</span>
                        </p>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <p class="text-sm text-green-500">{{ now()->format('d M Y H:i') }}</p>
                        <a href="#" class="text-blue-500 hover:text-blue-700 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ditolak Content -->
        <div id="rejected-content" class="tab-content space-y-4 hidden">
            <div class="bg-red-100 rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-red-800">Izin Ditolak</h2>
                    <p class="text-red-700">Maaf, permintaan izin Anda telah ditolak.</p>
                    <div class="mt-2">
                        <p class="text-sm text-red-600">
                            <span>Nama</span>
                            <span>:</span>
                            <span>Mamang cepot</span>
                        </p>
                        <p class="text-sm text-red-600">
                            <span>NIM</span>
                            <span class="ml-[11px]">:</span>
                            <span>123456789</span>
                        </p>
                    </div>
                    <p class="text-sm text-red-500 mt-2">{{ now()->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    function switchTab(tabId) {
        // Hide all tab contents
        tabContents.forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active state from all tabs
        tabButtons.forEach(btn => {
            btn.classList.remove('border-b-2', 'border-black');
            btn.classList.add('opacity-70');
        });

        // Show selected tab content
        const selectedContent = document.getElementById(`${tabId}-content`);
        selectedContent.classList.remove('hidden');

        // Add active state to selected tab
        const selectedTab = document.querySelector(`[data-tab="${tabId}"]`);
        selectedTab.classList.add('border-b-2', 'border-black');
        selectedTab.classList.remove('opacity-70');
    }

    // Add click event listeners to tabs
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            switchTab(tabId);
        });
    });
});
</script>

@endsection
