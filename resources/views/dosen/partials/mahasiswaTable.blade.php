
@if (isset($error))
    <tr>
        <td colspan="9" class="text-center text-red-500 py-4">
            {{ $error }}
        </td>
    </tr>
@else
    @foreach($dataMahasiswa as $index => $mahasiswa)
    <tr id="mahasiswa-row-{{ $mahasiswa->mahasiswa_id }}" class="bg-white border-b dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="p-1 text-center">
            {{ ($dataMahasiswa->currentPage() - 1) * $dataMahasiswa->perPage() + $index + 1 }}
        </td>
        <td class="px-6 py-3">{{ $mahasiswa->name }}</td>
        <td class="px-6 py-3">{{ $mahasiswa->NIM }}</td>
        <td class="px-6 py-3">{{ $mahasiswa->prodi }}</td>
        <td class="px-6 py-3">{{ $mahasiswa->tanggal_lahir }}</td>
        <td class="px-6 py-3">{{ $mahasiswa->email }}</td>
        <td class="px-6 py-3">{{ $mahasiswa->nomor_hp }}</td>
        <td class="px-6 py-3">{{ $mahasiswa->role->name }}</td>
        <td class="px-6 py-3 relative">
            <div class="absolute top-1/2 right-4 transform -translate-y-1/2">
                <button onclick="toggleActionMenu(this)" class="p-1 hover:bg-gray-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </button>
            </div>
            <div class="hidden action-menu absolute top-full right-0 mt-5 bg-white shadow-lg rounded-lg p-4 z-10 w-48">
                <div class="flex flex-col items-start space-y-2">
                    <button onclick="handleDelete({{ $mahasiswa->mahasiswa_id }})" class="flex items-center text-red-600 hover:text-red-800 transition-colors w-full py-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Delete</span>
                    </button>
                    <button onclick="handlePermissionRequest({{ $mahasiswa->mahasiswa_id }})" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors w-full py-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        <span>Izin</span>
                    </button>
                    <button onclick="handleEditRole({{ $mahasiswa->mahasiswa_id }})"
                        class="flex items-center text-green-600 hover:text-green-800 transition-colors w-full py-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>Edit intensitas</span>
                    </button>
                </div>
            </div>
        </td>
    </tr>
    @endforeach
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/js/dosen/dosen-home.js') }}"></script>
@endif


