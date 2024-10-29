@extends('navbar/navbar2')
@section('content')
<title>Profil</title>
<div class="min-h-screen bg-[#76aeb8] p-2 sm:p-4 md:p-6 lg:p-8 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 md:p-8 w-full max-w-[95%] sm:max-w-[90%] md:max-w-[80%] lg:max-w-[1000px] fixed top-1/2 transform -translate-y-1/2 mt-5 overflow-y-auto max-h-[90vh]">
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                {{$}}
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
            <button onclick="window.location='{{ route('dosen.editProfil') }}'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Edit
            </button>
            <button onclick="showLogoutConfirmation()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Logout
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

            {{-- Alert Logout--}}
            <div class="items-center px-4 py-3">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button id="logoutBtn" type="submit"
                    class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Ya
                    </button>
                </form>
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
