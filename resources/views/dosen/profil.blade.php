@extends('navbar/navbar2')
@section('content')
<title>Profil</title>
<div class="min-h-screen bg-[#76aeb8] p-2 sm:p-4 md:p-6 lg:p-8 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 md:p-8 w-full max-w-[95%] sm:max-w-[90%] md:max-w-[80%] lg:max-w-[1000px] fixed top-1/2 transform -translate-y-1/2 mt-5 overflow-y-auto max-h-[90vh]">
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <div class="border rounded-md p-2 bg-gray-100">
                <span id="email" class="text-gray-800">user@example.com</span>
            </div>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nama
            </label>
            <div class="border rounded-md p-2 bg-gray-100">
                <span id="name" class="text-gray-800">John Doe</span>
            </div>
        </div>
        <div class="flex justify-between">
            <button onclick="window.location='{{ route('dosen.editProfil') }}'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit
            </button>
            <button onclick="showLogoutConfirmation()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline flex items-center justify-center gap-2">
                Logout
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.3438 17.1563H18.6961C18.5836 17.1563 18.4782 17.2055 18.4078 17.2922C18.2438 17.4914 18.068 17.6836 17.8828 17.8664C17.1256 18.6245 16.2286 19.2286 15.2414 19.6453C14.2188 20.0773 13.1196 20.2989 12.0094 20.2969C10.8868 20.2969 9.79925 20.0766 8.77738 19.6453C7.79025 19.2286 6.89324 18.6245 6.13597 17.8664C5.37734 17.111 4.77243 16.2155 4.35472 15.2297C3.92113 14.2078 3.70316 13.1227 3.70316 12C3.70316 10.8774 3.92347 9.79222 4.35472 8.77035C4.77191 7.78363 5.37191 6.89535 6.13597 6.13363C6.90003 5.37191 7.78831 4.77191 8.77738 4.35472C9.79925 3.92347 10.8868 3.70316 12.0094 3.70316C13.1321 3.70316 14.2196 3.92113 15.2414 4.35472C16.2305 4.77191 17.1188 5.37191 17.8828 6.13363C18.068 6.31879 18.2414 6.51097 18.4078 6.70785C18.4782 6.79457 18.586 6.84379 18.6961 6.84379H20.3438C20.4914 6.84379 20.5828 6.67972 20.5008 6.5555C18.7032 3.76175 15.5578 1.91254 11.9836 1.92191C6.368 1.93597 1.86566 6.49457 1.92191 12.1032C1.97816 17.6227 6.47347 22.0782 12.0094 22.0782C15.5743 22.0782 18.7055 20.2313 20.5008 17.4446C20.5805 17.3203 20.4914 17.1563 20.3438 17.1563ZM22.4274 11.8524L19.1016 9.22738C18.9774 9.12894 18.7969 9.218 18.7969 9.37504V11.1563H11.4375C11.3344 11.1563 11.25 11.2407 11.25 11.3438V12.6563C11.25 12.7594 11.3344 12.8438 11.4375 12.8438H18.7969V14.625C18.7969 14.7821 18.9797 14.8711 19.1016 14.7727L22.4274 12.1477C22.4498 12.1302 22.4679 12.1077 22.4804 12.0822C22.4928 12.0566 22.4993 12.0285 22.4993 12C22.4993 11.9716 22.4928 11.9435 22.4804 11.9179C22.4679 11.8923 22.4498 11.8699 22.4274 11.8524Z" fill="white"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Konfirmasi Logout</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin keluar dari akun Anda?
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="logoutBtn" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                    Ya
                </button>
                <button id="cancelBtn" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showLogoutConfirmation() {
    document.getElementById('logoutModal').classList.remove('hidden');
}

function hideLogoutConfirmation() {
    document.getElementById('logoutModal').classList.add('hidden');
}

function logout() {
    // In a real application, this would trigger a logout action
    alert('Logout action would be triggered here');
    hideLogoutConfirmation();
}

document.getElementById('logoutBtn').addEventListener('click', logout);
document.getElementById('cancelBtn').addEventListener('click', hideLogoutConfirmation);

// Close the modal if clicking outside of it
window.onclick = function(event) {
    var modal = document.getElementById('logoutModal');
    if (event.target == modal) {
        hideLogoutConfirmation();
    }
}
</script>
@endsection
