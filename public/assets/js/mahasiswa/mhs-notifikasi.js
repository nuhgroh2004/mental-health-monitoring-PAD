function updateNotificationCounts() {
    // Get the current counts
    const unreadCount = document.getElementById('unread-notifications').children.length;
    const historyCount = document.getElementById('history-container').children.length;

    // Get the span elements
    const unreadSpan = document.querySelector('[data-tab="unread"] span');
    const historySpan = document.querySelector('[data-tab="history"] span');

    // Update the badges with new counts
    if (unreadSpan) unreadSpan.textContent = unreadCount;
    if (historySpan) historySpan.textContent = historyCount;

    // Optional: Log to verify updates
    console.log('Unread count:', unreadCount);
    console.log('History count:', historyCount);
}

function showApproveConfirmation(button) {
    const notificationItem = button.closest('.notification-item');

    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Anda akan memberikan izin dosen melihat laporan anda!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya!",
        cancelButtonText: "Batal!",
        customClass: {
            confirmButton: "btn btn-success w-24 mx-2",
            cancelButton: "btn btn-danger w-24 mx-2"
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Add fade-out animation
            notificationItem.classList.add('fade-out');

            setTimeout(() => {
                try {
                    // Clone the notification for history
                    const historyItem = notificationItem.cloneNode(true);

                    // Reset animation classes
                    historyItem.classList.remove('fade-out');
                    historyItem.classList.add('fade-in');

                    // Replace buttons with status
                    const buttonContainer = historyItem.querySelector('.button-container');
                    buttonContainer.innerHTML = `
                        <div class="flex items-center justify-end space-x-4">
                            <span class="font-medium text-green-500">Diizinkan</span>
                            <button class="delete-btn text-gray-500 hover:text-red-500 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>`;

                    // Add to history container
                    const historyContainer = document.getElementById('history-container');
                    historyContainer.insertBefore(historyItem, historyContainer.firstChild);

                    // Remove the original notification
                    notificationItem.remove();

                    // Update notification counts after DOM changes
                    setTimeout(updateNotificationCounts, 0);

                    // Show success message
                    Swal.fire({
                        title: "Diizinkan!",
                        text: "Izin telah diberikan.",
                        icon: "success"
                    });
                } catch (error) {
                    console.error('Error in approval process:', error);
                }
            }, 500);
        }
    });
}

function showRejectConfirmation(button) {
    const notificationItem = button.closest('.notification-item');

    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Anda akan menolak permintaan akses ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya!",
        cancelButtonText: "Batal!",
        customClass: {
            confirmButton: "btn btn-success w-24 mx-2",
            cancelButton: "btn btn-danger w-24 mx-2"
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Add fade-out animation
            notificationItem.classList.add('fade-out');

            setTimeout(() => {
                try {
                    // Clone the notification for history
                    const historyItem = notificationItem.cloneNode(true);

                    // Reset animation classes
                    historyItem.classList.remove('fade-out');
                    historyItem.classList.add('fade-in');

                    // Replace buttons with status
                    const buttonContainer = historyItem.querySelector('.button-container');
                    buttonContainer.innerHTML = `
                        <div class="flex items-center justify-end space-x-4">
                            <span class="font-medium text-red-500">Ditolak</span>
                            <button class="delete-btn text-gray-500 hover:text-red-500 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>`;

                    // Add to history container
                    const historyContainer = document.getElementById('history-container');
                    historyContainer.insertBefore(historyItem, historyContainer.firstChild);

                    // Remove the original notification
                    notificationItem.remove();

                    // Update notification counts after DOM changes
                    setTimeout(updateNotificationCounts, 0);

                    // Show success message
                    Swal.fire({
                        title: "Ditolak!",
                        text: "Permintaan izin telah ditolak.",
                        icon: "success"
                    });
                } catch (error) {
                    console.error('Error in rejection process:', error);
                }
            }, 500);
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    function switchTab(tabId) {
        // Hide all tab contents
        tabContents.forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active state from all tabs
        tabButtons.forEach(btn => {
            btn.classList.remove('border-b-2', 'border-black');
            btn.classList.add('opacity-70');
        });

        // Show selected tab content
        const selectedContent = document.getElementById(`${tabId}-content`);
        selectedContent.classList.remove('hidden');

        // Add active state to selected tab
        const selectedTab = document.querySelector(`[data-tab="${tabId}"]`);
        selectedTab.classList.add('border-b-2', 'border-black');
        selectedTab.classList.remove('opacity-70');
    }

    // Add click event listeners to tabs
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            switchTab(tabId);
        });
    });

    // Handle delete button clicks
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-btn')) {
            const notificationItem = e.target.closest('.notification-item');

            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Anda akan menghapus pesan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya!",
                cancelButtonText: "Batal!",
                customClass: {
                    confirmButton: "btn btn-success w-24 mx-2",
                    cancelButton: "btn btn-danger w-24 mx-2"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add fade-out animation
                    notificationItem.classList.add('fade-out');

                    // Remove the notification after animation
                    setTimeout(() => {
                        notificationItem.remove();
                        // Update counts after removal
                        setTimeout(updateNotificationCounts, 0);

                        // Show success message
                        Swal.fire({
                            title: "Dihapus!",
                            text: "Notifikasi berhail dihapus.",
                            icon: "success"
                        });
                    }, 500);
                }
            });
        }
    });

    // Initial count update
    updateNotificationCounts();
});
