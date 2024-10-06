@extends('navbar/navbar3')
@section('content')
<div class="bg-[#76aeb8] min-h-screen p-4">
    <div class="w-[100%] mx-auto">
        <div class="bg-white rounded-lg shadow-md p-4 mb-4">
            <h2 class="text-xl font-semibold mb-4">Notifikasi</h2>
        </div>

        <div id="notifications-container">
            @for ($i = 0; $i < 3; $i++)
            <div class="bg-white rounded-lg shadow-md p-4 mb-4 notification-item">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-500">6/04/2024</span>
                </div>
                <p class="font-semibold mb-1">Hasan Dabukke ingin melihat laporan anda</p>
                <p class="text-sm text-gray-600 mb-4">hasanajbd1277@mail.ugm</p>
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
