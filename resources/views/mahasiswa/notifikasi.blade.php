@extends('navbar/navbar-mahasiswa')
@section('content')
<title>Notifikasi</title>

<div class="bg-white min-h-screen p-4">
    <div class="w-full mx-auto">
        <div class="container-notif bg-white rounded-lg shadow-lg p-4 mb-4 text-center">
            <h2 class="text-xl font-semibold">Notifikasi</h2>
        </div>

        <!-- Tab Navigation -->
        <div class="mb-6 flex border-b">
            <button class="tab-btn px-6 py-2 text-black font-medium border-b-2 border-black" data-tab="unread">
                Belum Dibaca
                <span class="ml-1 bg-red-500 text-white rounded-full px-2 py-0.5 text-xs">3</span>
            </button>
            <button class="tab-btn px-6 py-2 text-black font-medium opacity-70" data-tab="history">
                Riwayat
                <span class="ml-1 bg-gray-500 text-white rounded-full px-2 py-0.5 text-xs">0</span>
            </button>
        </div>

        <!-- Unread Notifications Tab -->
        <div id="unread-content" class="tab-content">
            <div id="unread-notifications">
                @for ($i = 0; $i < 3; $i++)
                <div class="bg-white rounded-lg shadow-lg p-4 mb-4 notification-item transform transition-all duration-500 ease-in-out">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-500">6/04/2024</span>
                    </div>
                    <p class="font-semibold mb-1">Nuhgroh ganteng ingin melihat laporan anda</p>
                    <p class="text-sm text-gray-600 mb-4">nuhgroh.ganteng@mail.ugm</p>
                    <div class="flex justify-end space-x-2 button-container">
                        <button onclick="showApproveConfirmation(this)" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-300 ease-in-out transform hover:scale-105 approve-btn">
                            Izinkan
                        </button>
                        <button onclick="showRejectConfirmation(this)" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-300 ease-in-out transform hover:scale-105 reject-btn">
                            Tolak
                        </button>
                    </div>
                </div>

            @endfor
        </div>
    </div>

        <!-- History Tab -->
        <div id="history-content" class="tab-content hidden">
            <div id="history-container">
                <!-- History items will be added here dynamically -->
            </div>
        </div>
    </div>
</div>
@endsection
