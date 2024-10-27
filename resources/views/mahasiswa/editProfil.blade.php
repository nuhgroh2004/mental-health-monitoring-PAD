<link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
@vite('resources/css/app.css')
<title>Edit Profil</title>
<div class="min-h-screen bg-[#76aeb8] p-2 sm:p-4 md:p-6 lg:p-8 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 md:p-8 w-full max-w-[95%] sm:max-w-[90%] md:max-w-[80%] lg:max-w-[1000px] fixed top-1/2 transform -translate-y-1/2 mt-5 overflow-y-auto max-h-[90vh]">
        <form onsubmit="return false;" class="space-y-4 md:space-y-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" value="user@example.com">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nama
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" value="John Doe">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Leave blank to keep current password">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="NIM">
                    NIM
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Leave blank to keep current password">
            </div>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <button onclick="window.location='{{ route('mahasiswa.profil') }}'" type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full sm:w-1/2 flex items-center justify-center">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </button>
                <button onclick="saveChanges(); window.location='{{ route('mahasiswa.profil') }}'" type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full sm:w-1/2 flex items-center justify-center">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function saveChanges() {
        // In a real application, this would save the changes
        alert('Changes would be saved here');
        // Note: The redirect is already handled by the onclick attribute
    }
    </script>
