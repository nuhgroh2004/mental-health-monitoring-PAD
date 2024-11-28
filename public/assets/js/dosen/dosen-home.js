// bagian dropdown tombol aksi
function toggleActionMenu(button) {
    const actionMenu = button.closest('td').querySelector('.action-menu');
    const allActionMenus = document.querySelectorAll('.action-menu');

    allActionMenus.forEach(menu => {
        if (menu !== actionMenu) {
            menu.classList.add('hidden');
            menu.classList.remove('flex');
        }
    });

    actionMenu.classList.toggle('hidden');
    actionMenu.classList.toggle('flex');

    const rect = actionMenu.getBoundingClientRect();
    const tableHeight = document.querySelector('table').offsetHeight;
    const pageHeight = window.innerHeight;

    if (rect.bottom > pageHeight || rect.bottom > tableHeight) {
        actionMenu.style.top = 'auto';
        actionMenu.style.bottom = '100%';
    } else {
        actionMenu.style.top = '100%';
        actionMenu.style.bottom = 'auto';
    }

    const allButtons = document.querySelectorAll('.action-button');
    allButtons.forEach(btn => {
        if (btn !== button) {
            btn.disabled = !actionMenu.classList.contains('hidden');
        }
    });
}


// fungsi pencarian mahasiswa
document.getElementById('search').addEventListener('input', function() {
    let query = this.value;
    let searchUrl = document.getElementById('search').getAttribute('data-search-url');

    fetch(`${searchUrl}?query=${query}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('mahasiswaTable').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
});


// fungsi delete mahasiswa
function handleDelete(mahasiswaId) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success w-24 mx-2",
            cancelButton: "btn btn-danger w-24 mx-2"
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
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/dosen/mahasiswa/delete/${mahasiswaId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    swalWithBootstrapButtons.fire({
                        title: "Dihapus!",
                        text: "User berhasil dihapus.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = "/dosen/home";
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
            swalWithBootstrapButtons.fire({
                title: "Dibatalkan",
                text: "User batal dihapus :)",
                icon: "error"
            });
        }
    });
}


// fungsi edit role mahasiswa
function handleEditRole(mahasiswaId) {
    Swal.fire({
        title: "Pilih Role",
        html: `
            <div id="roleImages" class="flex justify-center space-x-4">
                <img id="emojiMarah" src="/asset/svg/emoji/marah.svg" alt="Marah Emoji" class="inline-block w-[70px] h-[70px]">
                <img id="emojiSedih" src="/asset/svg/emoji/sedih.svg" alt="Sedih Emoji" class="inline-block w-[70px] h-[70px]">
                <img id="emojiBiasaSaja" src="/asset/svg/emoji/biasaSaja.svg" alt="Biasa Saja Emoji" class="inline-block w-[70px] h-[70px]">
                <img id="emojiHappy" src="/asset/svg/emoji/happy.svg" alt="Happy Emoji" class="inline-block w-[70px] h-[70px]">
            </div>
            <div class="flex justify-center space-x-4 mt-4">
                <button id="role1" class="swal2-confirm swal2-styled  px-4 py-2 rounded">
                    Role 1
                </button>
                <button id="role2" class="swal2-confirm swal2-styled  px-4 py-2 rounded">
                    Role 2
                </button>
            </div>
        `,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: "Simpan",
        cancelButtonText: "Batal",
        customClass: {
            confirmButton: "btn btn-success w-24 mx-2",
            cancelButton: "btn btn-danger w-24 mx-2"
        },
        didOpen: () => {
            const role1Button = document.getElementById("role1");
            const role2Button = document.getElementById("role2");
            const emojiMarah = document.getElementById("emojiMarah");
            const emojiSedih = document.getElementById("emojiSedih");
            const emojiBiasaSaja = document.getElementById("emojiBiasaSaja");
            const emojiHappy = document.getElementById("emojiHappy");

            const setActiveRole = (role) => {
                if (role === "role1") {
                    role1Button.style.border = "2px solid white";
                    role1Button.style.boxShadow = "0 0 10px rgba(0, 0, 0, 0.2)";
                    role1Button.style.backgroundColor = "green";
                    role1Button.style.color = "white";
                    role2Button.style.border = "none";
                    role2Button.style.boxShadow = "none";
                    role2Button.style.backgroundColor = "white";
                    role2Button.style.color = "black";

                    emojiMarah.style.display = "inline-block";
                    emojiSedih.style.display = "inline-block";
                    emojiBiasaSaja.style.display = "inline-block";
                    emojiHappy.style.display = "inline-block";
                } else {
                    role2Button.style.border = "2px solid white";
                    role2Button.style.boxShadow = "0 0 10px rgba(0, 0, 0, 0.2)";
                    role2Button.style.backgroundColor = "green";
                    role2Button.style.color = "white";
                    role1Button.style.border = "none";
                    role1Button.style.boxShadow = "none";
                    role1Button.style.backgroundColor = "white";
                    role1Button.style.color = "black";

                    emojiMarah.style.display = "inline-block";
                    emojiSedih.style.display = "inline-block";
                    emojiBiasaSaja.style.display = "none";
                    emojiHappy.style.display = "inline-block";
                }
            };

            setActiveRole("role1");

            role1Button.addEventListener("click", () => setActiveRole("role1"));
            role2Button.addEventListener("click", () => setActiveRole("role2"));
        },
        preConfirm: () => {
            const selectedRole = document.getElementById("role1").style.backgroundColor === "green" ? "role_1" : "role_2";
            return axios.post(`/dosen/edit-role/${mahasiswaId}`, { role: selectedRole })
                .then((response) => {
                    Swal.fire({
                        title: "Berhasil!",
                        text: response.data.message,
                        icon: "success",
                        confirmButtonText: "Oke",
                    }).then(() => window.location.reload());
                })
                .catch((error) => {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: error.response?.data?.message || "Terjadi kesalahan!",
                    });
                });
        },
    });
}



function handlePermissionRequest(mahasiswaId) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success w-24 mx-2",
            cancelButton: "btn btn-danger w-24 mx-2"
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
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post(`/dosen/mahasiswa/${mahasiswaId}/izin`)
                .then(response => {
                    if (response.data.success) {
                        swalWithBootstrapButtons.fire({
                            title: "Berhasil!",
                            text: response.data.message,
                            icon: "success",
                        });
                    } else {
                        swalWithBootstrapButtons.fire({
                            title: "Gagal",
                            text: "Permintaan gagal diproses.",
                            icon: "error",
                        });
                    }
                })
                .catch(error => {
                    swalWithBootstrapButtons.fire({
                        title: "Gagal",
                        text: error.response?.data?.message || "Terjadi kesalahan jaringan atau server!",
                        icon: "error",
                    });
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

