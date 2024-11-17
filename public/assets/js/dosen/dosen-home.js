document.getElementById('search').addEventListener('input', function() {
    let query = this.value;

    // Ambil URL dari data atribut
    let searchUrl = document.getElementById('search').getAttribute('data-search-url');

    // Lakukan request AJAX
    fetch(`${searchUrl}?query=${query}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(data => {
        // Perbarui tabel dengan data yang diterima
        document.getElementById('mahasiswaTable').innerHTML = data;
    })
    .catch(error => console.error('Error:', error)); // Jika terjadi error
});



function handleDelete(mahasiswaId) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success w-24 mx-2",
            cancelButton: "btn btn-danger w-24 mx-2"
        },
        buttonsStyling: false
    });

    // Menampilkan SweetAlert konfirmasi penghapusan
    swalWithBootstrapButtons.fire({
        title: "Apa kamu yakin?",
        text: "Ingin menghapus user ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya!",
        cancelButtonText: "Tidak!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika "Ya" ditekan, lakukan penghapusan data di server
            // Menggunakan fetch atau XHR untuk menghapus data tanpa memuat ulang halaman
            fetch(`/dosen/mahasiswa/delete/${mahasiswaId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Optional untuk menandakan ini adalah request Ajax
                }
            })
            .then(response => response.json()) // Mengharapkan respons JSON
            .then(data => {
                // Tampilkan SweetAlert setelah data berhasil dihapus
                if (data.success) {
                    swalWithBootstrapButtons.fire({
                        title: "Dihapus!",
                        text: "User berhasil dihapus.",
                        icon: "success"
                    }).then(() => {
                        // Setelah tombol "OK" ditekan, redirect ke halaman dosen
                        window.location.href = "/dosen/landingPage";
                    });
                } else {
                    swalWithBootstrapButtons.fire({
                        title: "Gagal",
                        text: "Terjadi kesalahan saat menghapus user.",
                        icon: "error"
                    });
                }
            })
            .catch(error => {
                swalWithBootstrapButtons.fire({
                    title: "Error",
                    text: "Terjadi kesalahan server.",
                    icon: "error"
                });
            });
        } else {
            // Jika "Tidak" ditekan, tampilkan pesan pembatalan
            swalWithBootstrapButtons.fire({
                title: "Dibatalkan",
                text: "User batal dihapus :)",
                icon: "error"
            });
        }
    });
}



function handlePermissionRequest() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Apa kamu yakin?",
        text: "Ingin mengirim permintaan izin!",
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
                title: "Dikirim!",
                text: "Permintaan izin berhasil dikirim.",
                icon: "success"
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Dibatalkan",
                text: "Permintaan izin dibatalkan :)",
                icon: "error"
            });
        }
    });
}
