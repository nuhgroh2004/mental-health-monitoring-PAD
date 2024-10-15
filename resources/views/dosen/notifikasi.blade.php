@extends('navbar/navbar2')
@section('content')
<title>Notifikasi</title>

<div class="min-h-screen bg-[#76aeb8] p-8">
    <h1 class="text-3xl font-bold text-white mb-6">Notifikasi</h1>
    <div class="space-y-4">
        <!-- Notifikasi Permintaan Persetujuan -->
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
                        <span >123456789</span>
                    </p>
                </div>
                <p class="text-sm text-yellow-500 mt-2">{{ now()->format('d M Y H:i') }}</p>
            </div>
        </div>

        <!-- Notifikasi Izin Disetujui -->
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
                        <span >123456789</span>
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

        <!-- Notifikasi Izin Ditolak -->
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
                        <span >123456789</span>
                    </p>
                </div>
                <p class="text-sm text-red-500 mt-2">{{ now()->format('d M Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>

@endsection
