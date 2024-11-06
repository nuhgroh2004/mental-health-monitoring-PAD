@extends('navbar/navbar-mahasiswa')
@section('content')

<title>Notifikasi</title>

<div class=" bg-white min-h-screen p-4">
    <div class="w-full mx-auto">
        <div class="container-notif bg-white rounded-lg shadow-lg p-4 mb-4 text-center">
            <h2 class="text-xl font-semibold ">Notifikasi</h2>
        </div>

        <div id="notifications-container">
            @for ($i = 0; $i < 3; $i++)
            <div class="bg-white rounded-lg shadow-lg p-4 mb-4 notification-item">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-500">6/04/2024</span>
                </div>
                <p class="font-semibold mb-1">Nuhgroh ganteng ingin melihat laporan anda</p>
                <p class="text-sm text-gray-600 mb-4">nuhgroh ganteng@mail.ugm</p>
                <div class="flex justify-end space-x-2 button-container">
                    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-300 ease-in-out transform hover:scale-105 approve-btn">
                        Izinkan
                    </button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-300 ease-in-out transform hover:scale-105 reject-btn">
                        Tolak
                    </button>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>

@endsection
