{{-- bautkan struktur hatml dengan mengggunakan telwin css untuk menampilkan pesan email berupa kode otp 4 angka buat tampilannya menarik --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email OTP</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden md:max-w-md">
        <div class="md:flex">
            <div class="w-full p-4">
                <div class="relative">
                    <h2 class="text-2xl font-bold text-center text-gray-800">4 5 3 2</h2>
                    <p class="text-center text-gray-600 mt-2">Use the following OTP code to complete your transaction:</p>
                    <div class="mt-4 text-center">
                        <span class="text-4xl font-bold text-blue-600">{{ $otp }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
