
 // <<<<<<<<<<<<<<<<<<---------- ladning page dose animasi munculnya hasil pencarian ---------------->>>>>>>>>>>>>>>>>>>> //
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('searchForm');
        const searchResults = document.getElementById('searchResults');

        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Show the search results with a fade-in animation
            searchResults.classList.remove('hidden');
            searchResults.style.opacity = '0';
            setTimeout(() => {
                searchResults.style.opacity = '1';
            }, 10);

            // Here you would typically fetch and display actual results
            // For now, we're just showing the dummy content
        });
    });
// <<<<<<<<<<<<<<<<<<---------- ladning page dose animasi munculnya hasil pencarian ---------------->>>>>>>>>>>>>>>>>>>> //

// <<<<<<<<<<<<<<<<<<---------- navbar 2 dan 3 menu ---------------->>>>>>>>>>>>>>>>>>>> //
document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.menu-item');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const slider3 = document.getElementById('slider-3');

    // Fungsi untuk menggerakkan slider ke posisi item aktif
    function moveSlider(item) {
        const itemRect = item.getBoundingClientRect();
        const containerRect = item.parentElement.getBoundingClientRect();
        slider3.style.left = `${itemRect.left - containerRect.left}px`;
        slider3.style.width = `${itemRect.width}px`;
    }

    // Fungsi untuk mengaktifkan menu item dan menggerakkan slider
    function setActiveMenuItem(item) {
        menuItems.forEach(menuItem => {
            menuItem.classList.remove('active');
        });
        item.classList.add('active');

        // Simpan ID item menu yang aktif di Local Storage
        localStorage.setItem('activeMenu', item.getAttribute('data-menu'));

        // Pindahkan slider
        moveSlider(item);
    }

    // Fungsi untuk menampilkan atau menyembunyikan slider tergantung ukuran layar
    function handleSliderVisibility() {
        if (window.innerWidth <= 640) {
            slider3.style.display = 'none'; // Sembunyikan slider pada layar kecil
        } else {
            slider3.style.display = 'block'; // Tampilkan slider pada layar besar

            // Ambil item aktif dari Local Storage jika ada, jika tidak, ambil item pertama
            const activeMenu = localStorage.getItem('activeMenu') || menuItems[0].getAttribute('data-menu');
            const activeMenuItem = Array.from(menuItems).find(item => item.getAttribute('data-menu') === activeMenu);
            if (activeMenuItem) {
                setActiveMenuItem(activeMenuItem);
            }
        }
    }

    // Event listener untuk klik item menu
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            setActiveMenuItem(this);
        });
    });

    // Toggle menu mobile
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Event listener untuk perubahan ukuran layar (resize)
    window.addEventListener('resize', handleSliderVisibility);

    // Panggil fungsi saat halaman pertama kali dimuat
    handleSliderVisibility();
});

// <<<<<<<<<<<<<<<<<<---------- navbar 2 dan 3 menu ---------------->>>>>>>>>>>>>>>>>>>> //


// <<<<<<<<<<<<<<<<<<---------- create user ---------------->>>>>>>>>>>>>>>>>>>> //
function createUserForm() {
    return {
        users: [{ email: '', password: '', name: '', nim: '', showPassword: false }], // Daftar user
        createdUsers: [], // Menyimpan user yang sudah dibuat
        showCreatedUsers: false, // Mengontrol tampilan daftar user yang sudah dibuat
        excelCreationSuccess: false, // Notifikasi kesuksesan impor Excel

        // Menambahkan user baru
        addUser() {
            this.users.push({ email: '', password: '', name: '', nim: '', showPassword: false });
        },

        // Menghapus user dari form
        removeUser(index) {
            this.users.splice(index, 1);
        },

        // Menyimpan data user yang dibuat ke dalam daftar user yang dibuat
        submitForm() {
            this.createdUsers = [...this.createdUsers, ...this.users];
            this.showCreatedUsers = true;
            this.users = [{ email: '', password: '', name: '', nim: '', showPassword: false }];
        },

        // Mengunggah dan memproses file Excel
        handleDrop(event) {
            const file = event.dataTransfer.files[0];
            this.processExcelFile(file);
        },
        handleFileSelect(event) {
            const file = event.target.files[0];
            this.processExcelFile(file);
        },
        processExcelFile(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, { type: 'array' });
                const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
                const excelData = XLSX.utils.sheet_to_json(firstSheet);
                this.createdUsers = excelData.map(row => ({
                    email: row.Email,
                    password: row.Password,
                    name: row.Name,
                    nim: row.NIM,
                }));
            };
            reader.readAsArrayBuffer(file);
        },

        // Mengunduh daftar user sebagai file Excel
        downloadExcel() {
            const wb = XLSX.utils.book_new();
            const data = this.createdUsers.map((user, index) => ({
                No: index + 1,
                Email: user.email,
                Password: user.password,
                Name: user.name,
                NIM: user.nim
            }));
            const ws = XLSX.utils.json_to_sheet(data);
            XLSX.utils.book_append_sheet(wb, ws, "Users");
            XLSX.writeFile(wb, "created_users.xlsx");
        },

        // Mengunduh template Excel untuk impor user
        downloadTemplate() {
            const wb = XLSX.utils.book_new();
            const data = [{ No: 1, Email: '', Password: '', Name: '', NIM: '' }];
            const ws = XLSX.utils.json_to_sheet(data);
            XLSX.utils.book_append_sheet(wb, ws, "Template");
            XLSX.writeFile(wb, "user_template.xlsx");
        },

        // Menampilkan notifikasi kesuksesan impor Excel
        submitExcel() {
            this.excelCreationSuccess = true;
            setTimeout(() => {
                this.excelCreationSuccess = false;
            }, 3000); // Menghilangkan notifikasi setelah 3 detik
        }
    };
}

// <<<<<<<<<<<<<<<<<<---------- create user ---------------->>>>>>>>>>>>>>>>>>>> //

// <<<<<<<<<<<<<<<<<<---------- allert meminta izin dan delete pada landing page dosen ---------------->>>>>>>>>>>>>>>>>>>> //
function openDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Open and close request permission modal
function openRequestPermissionModal() {
    document.getElementById('requestPermissionModal').classList.remove('hidden');
}
function closeRequestPermissionModal() {
    document.getElementById('requestPermissionModal').classList.add('hidden');
}

// Confirm delete action
function confirmDelete() {
    document.getElementById('deleteModal').classList.add('hidden');
    showAlert('deleteAlert');
}

// Confirm request permission action
function confirmRequestPermission() {
    document.getElementById('requestPermissionModal').classList.add('hidden');
    showAlert('requestPermissionAlert');
}

// Function to show alert
function showAlert(alertId) {
    const alertElement = document.getElementById(alertId);
    alertElement.classList.remove('hidden');
    setTimeout(() => {
        alertElement.classList.add('hidden');
    }, 3000); // Hide alert after 3 seconds
}
// <<<<<<<<<<<<<<<<<<---------- allert meminta izin dan delete pada landing page dosen ---------------->>>>>>>>>>>>>>>>>>>> //



// <<<<<<<<<<<<<<<<<<---------- allert logout  ---------------->>>>>>>>>>>>>>>>>>>> //
  // Menampilkan dan menyembunyikan menu mobile
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  mobileMenuButton.addEventListener('click', function() {
    mobileMenu.classList.toggle('hidden');
  });

  // Fungsi untuk menampilkan modal
  function showLogoutAlert() {
    document.getElementById('logoutModal').classList.remove('hidden');
  }

  // Menyembunyikan modal ketika klik tombol 'Tidak'
  document.getElementById('cancelLogout').addEventListener('click', function() {
    document.getElementById('logoutModal').classList.add('hidden');
    history.back(); // Kembali ke halaman sebelumnya
  });

  // Aksi logout ketika klik tombol 'Ya'
  document.getElementById('confirmLogout').addEventListener('click', function() {
    alert('Anda berhasil log out!');
    document.getElementById('logoutModal').classList.add('hidden');
    // Di sini bisa diletakkan logika untuk melakukan logout
  });
// <<<<<<<<<<<<<<<<<<---------- allert logout  ---------------->>>>>>>>>>>>>>>>>>>> //
