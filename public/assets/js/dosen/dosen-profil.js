function logout() {
    // Add your logout logic here
    hideLogoutConfirmation();
}

// Close the modal if clicking outside of it
window.onclick = function(event) {
    var modal = document.getElementById('logoutModal');
    if (event.target == modal) {
        hideLogoutConfirmation();
    }
}

function showLogoutConfirmation() {
    document.getElementById('logoutModal').classList.remove('hidden');
}

function hideLogoutConfirmation() {
    document.getElementById('logoutModal').classList.add('hidden');
}


function saveChangesaa() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Apa kamu yakin?",
        text: "Ingin mengubah profil!",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya!",
        cancelButtonText: "Tidak!",
        reverseButtons: true,
        customClass: {
                confirmButton: "btn btn-success w-24 mx-2",
                cancelButton: "btn btn-danger w-24 mx-2"
            }
        }).then((result) => {
        if (result.isConfirmed) {
            // Add your delete logic here

            swalWithBootstrapButtons.fire({
            title: "Berhasil!",
            text: "Profil telah diperbaruin",
            icon: "success"
            }).then(() => {
            window.location.href = "/dosen/profil";
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
            title: "Batal",
            text: "Profil gagal diperbarui :)",
            icon: "error"
            });
        }
        });
}
