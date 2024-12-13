@extends('navbar/navbar-mahasiswa')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                <span class="ml-1 bg-red-500 text-white rounded-full px-2 py-0.5 text-xs">{{ $unreadNotifications->count() }}</span>
            </button>
            <button class="tab-btn px-6 py-2 text-black font-medium opacity-70" data-tab="history">
                Riwayat
                <span class="ml-1 bg-gray-500 text-white rounded-full px-2 py-0.5 text-xs">{{ $historyNotifications->count() }}</span>
            </button>
        </div>

        <!-- Unread Notifications Tab -->
        <div id="unread-content" class="tab-content">
            @foreach ($unreadNotifications as $notification)
                <div class="bg-white rounded-lg shadow-lg p-4 mb-4 notification-item transform transition-all duration-500 ease-in-out">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-500">{{ $notification->created_at->format('d/m/Y') }}</span>
                    </div>
                    <p class="font-semibold mb-1">{{ $notification->name }} ingin melihat laporan anda</p>
                    <p class="text-sm text-gray-600 mb-4">{{ $notification->email }}</p>
                    <div class="flex justify-end space-x-2 button-container">
                        <button onclick="showApproveConfirmation(this, {{ $notification->notification_id }})"
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-300 ease-in-out transform hover:scale-105 approve-btn">
                            Izinkan
                        </button>
                        <button onclick="showRejectConfirmation(this, {{ $notification->notification_id }})"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-300 ease-in-out transform hover:scale-105 reject-btn">
                            Tolak
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- History Tab -->
        <div id="history-content" class="tab-content hidden">
            @foreach ($historyNotifications as $notification)
                <div class="bg-gray-100 rounded-lg shadow-lg p-4 mb-4 notification-item">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-500">{{ $notification->updated_at->format('d/m/Y') }}</span>
                        <span class="text-sm {{ $notification->request_status === 'accepted' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($notification->request_status) }}
                        </span>
                    </div>
                    <p class="font-semibold mb-1">{{ $notification->name }} telah meminta laporan anda</p>
                    <p class="text-sm text-gray-600">{{ $notification->email }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
