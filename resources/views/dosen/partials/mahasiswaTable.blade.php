
@if (isset($error))
    <tr>
        <td colspan="9" class="text-center text-red-500 py-4">
            {{ $error }}
        </td>
    </tr>
@else
    @foreach($dataMahasiswa as $index => $mahasiswa)
    <tr id="mahasiswa-row-{{ $mahasiswa->mahasiswa_id }}" class="bg-white border-b dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="p-4">
            <div class="flex items-center">
                <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            </div>
        </td>
        <td class="px-6 py-3">{{ $mahasiswa->name }}</td>
        <td class="px-6 py-3">{{ $mahasiswa->NIM }}</td>
        <td class="px-6 py-3">{{ $mahasiswa->prodi }}</td>
        <td class="px-6 py-3">{{ $mahasiswa->tanggal_lahir }}</td>
        <td class="px-6 py-3">{{ $mahasiswa->email }}</td>
        <td class="px-6 py-3">{{ $mahasiswa->nomor_hp }}</td>
        <td class="px-6 py-3">{{ $mahasiswa->mahasiswa_role }}</td>
        <td class="px-6 py-3 flex-col space-y-4 justify-center text-center ">

            <button onclick="handleDelete({{ $mahasiswa->mahasiswa_id }})" class="font-bold text-white bg-red-600 hover:bg-red-500 hover:underline text-center py-2 px-4 rounded w-32">Delete</button>
            <button onclick="handlePermissionRequest({{ $mahasiswa->mahasiswa_id }})" class="font-bold text-white bg-blue-600 dark:bg-blue-500 hover:bg-blue-400 hover:underline text-center py-2 px-4 rounded w-32">Izin</button>
            <button onclick="handleEditRole({{ $mahasiswa->mahasiswa_id }})" class="font-bold text-white bg-green-600 dark:bg-green-500 hover:bg-green-400 hover:underline text-center py-2 px-4 rounded w-32">Edit Role</button>
        </td>
    </tr>

    @endforeach
    <script src="{{ asset('assets/js/dosen/dosen-home.js') }}"></script>
@endif


