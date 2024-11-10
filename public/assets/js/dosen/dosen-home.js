function handleDelete() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Apa kamu yakin?",
        text: "Ingin menghapus user ini!",
        icon: "warning",
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
                title: "Dihapus!",
                text: "User berhasil dihpus.",
                icon: "success"
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
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
