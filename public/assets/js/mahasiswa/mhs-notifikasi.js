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
