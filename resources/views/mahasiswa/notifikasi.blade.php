@extends('navbar/navbar3')
@section('content')
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>GamaPulse</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicons -->
    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<title>Notifikasi</title>

<div class=" bg-[#76aeb8] min-h-screen p-4">
    <div class="w-full mx-auto">
        <div class="bg-white rounded-lg shadow-md p-4 mb-4 text-center">
            <h2 class="text-xl font-semibold mb-4">Notifikasi</h2>
        </div>

        <div id="notifications-container">
            @for ($i = 0; $i < 3; $i++)
            <div class="bg-white rounded-lg shadow-md p-4 mb-4 notification-item">
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

<style>
    @media (max-width: 640px) {
        .notification-item {
            padding: 1rem;
        }
        .button-container button {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
    }
</style>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const notificationsContainer = document.getElementById('notifications-container');

    notificationsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('approve-btn') || e.target.classList.contains('reject-btn')) {
            const notificationItem = e.target.closest('.notification-item');
            const buttonContainer = notificationItem.querySelector('.button-container');
            const action = e.target.classList.contains('approve-btn') ? 'approve' : 'reject';

            // Animate button container
            buttonContainer.style.transition = 'opacity 0.5s, transform 0.5s';
            buttonContainer.style.opacity = '0';
            buttonContainer.style.transform = 'scale(0.8)';

            // Remove button container and add status indicator after animation
            setTimeout(() => {
                buttonContainer.remove();

                const statusIndicator = document.createElement('div');
                statusIndicator.className = `text-sm font-semibold ${action === 'approve' ? 'text-green-600' : 'text-red-600'}`;
                statusIndicator.textContent = action === 'approve' ? 'Diizinkan' : 'Ditolak';

                statusIndicator.style.opacity = '0';
                statusIndicator.style.transform = 'translateY(10px)';
                notificationItem.appendChild(statusIndicator);

                // Animate status indicator
                setTimeout(() => {
                    statusIndicator.style.transition = 'opacity 0.5s, transform 0.5s';
                    statusIndicator.style.opacity = '1';
                    statusIndicator.style.transform = 'translateY(0)';
                }, 50);
            }, 500);
        }
    });
});
</script>
@endsection
