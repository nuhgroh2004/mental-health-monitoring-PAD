function updateNotificationCounts() {
    const unreadCount = document.getElementById('unread-content').children.length;
    const historyCount = document.getElementById('history-content').children.length;

    const unreadSpan = document.querySelector('[data-tab="unread"] span');
    const historySpan = document.querySelector('[data-tab="history"] span');

    if (unreadSpan) unreadSpan.textContent = unreadCount;
    if (historySpan) historySpan.textContent = historyCount;
}

function updateNotification(id, action) {
    return fetch(`/mahasiswa/notifikasi/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ action }),
    }).then(response => response.json());
}

function moveToHistory(notificationItem, statusText, statusColor) {
    const historyItem = notificationItem.cloneNode(true);

    historyItem.classList.remove('fade-out');
    historyItem.classList.add('fade-in');

    const buttonContainer = historyItem.querySelector('.button-container');
    buttonContainer.innerHTML = `
        <div class="flex items-center justify-end space-x-4">
            <span class="font-medium ${statusColor}">${statusText}</span>
        </div>
    `;

    document.getElementById('history-content').appendChild(historyItem);
    notificationItem.remove();
    updateNotificationCounts();
}

function showApproveConfirmation(button, id) {
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
            updateNotification(id, 'approve').then(data => {
                if (data.success) {
                    // Move the notification to the history tab
                    moveToHistory(notificationItem, "Diizinkan", "text-green-500");
                    Swal.fire("Berhasil!", "Izin telah diberikan.", "success");
                } else {
                    Swal.fire("Gagal!", "Terjadi kesalahan.", "error");
                }
            });
        }
    });
}

function showRejectConfirmation(button, id) {
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
            updateNotification(id, 'reject').then(data => {
                if (data.success) {
                    // Move the notification to the history tab
                    moveToHistory(notificationItem, "Ditolak", "text-red-500");
                    Swal.fire("Berhasil!", "Permintaan izin telah ditolak.", "success");
                } else {
                    Swal.fire("Gagal!", "Terjadi kesalahan.", "error");
                }
            });
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
    document.addEventListener('DOMContentLoaded', () => {
        updateNotificationCounts();

        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                tabContents.forEach(content => content.classList.add('hidden'));
                document.querySelector(`#${button.dataset.tab}-content`).classList.remove('hidden');

                tabButtons.forEach(btn => btn.classList.remove('border-black', 'opacity-100'));
                button.classList.add('border-black', 'opacity-100');
            });
        });

    // Initial count update
    updateNotificationCounts();
});

});
