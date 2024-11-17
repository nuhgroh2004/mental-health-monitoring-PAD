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

    // Ambil URL dari tombol save
    const updateUrl = document.querySelector('button[onclick="saveChangesaa()"]').dataset.url;

    swalWithBootstrapButtons.fire({
        title: "Apa kamu yakin?",
        text: "Ingin mengubah profil!",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya!",
        cancelButtonText: "Tidak!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Membuat form data
            const formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('password').value);

            // Kirim request ke endpoint update profil menggunakan URL dari data attribute
            fetch(updateUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                swalWithBootstrapButtons.fire({
                    title: "Berhasil!",
                    text: "Profil telah diperbarui",
                    icon: "success"
                }).then(() => {
                    window.location.href = "/dosen/profil";
                });
            })
            .catch(error => {
                let errorMessage = "Terjadi kesalahan saat memperbarui profil";
                if (error.message) {
                    errorMessage = error.message;
                } else if (error.errors) {
                    errorMessage = Object.values(error.errors).flat().join('\n');
                }

                swalWithBootstrapButtons.fire({
                    title: "Gagal!",
                    text: errorMessage,
                    icon: "error"
                });
            });
        } else {
            swalWithBootstrapButtons.fire({
                title: "Batal",
                text: "Profil gagal diperbarui :)",
                icon: "error"
            });
        }
    });
}
