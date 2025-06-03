function createUserForm() {
    return {
        dragOver: false,
        fileName: '',
        selectedFile: null,

        handleFileSelect(event) {
            const file = event.target.files[0];
            console.log('File Selected: ', file);
            if (file) {
                this.selectedFile = file;
                this.fileName = file.name;
            }
        },

        removeFile() {
            this.selectedFile = null;
            this.fileName = '';
            this.$refs.fileInput.value = '';
        },

        users: [{
            email: '',
            password: '',
            name: '',
            nim: '',
            prodi: null,
            tanggal_lahir: null,
            phone: null,
            Password: '',
            role: 1,
            showPassword: false
        }],
        createdUsers: [],
        showCreatedUsers: false,
        excelCreationSuccess: false,

        addUser() {
            this.users.push({
                email: '',
                password: '',
                name: '',
                nim: '',
                prodi: null,
                tanggal_lahir: null,
                phone: null,
                Password: '',
                role: 1,
                showPassword: false
            });
        },

        removeUser(index) {
            this.users.splice(index, 1);
        },

        submitForm() {
            // Ngambil token CSRF dari meta tag
            const csrf_token = document.querySelector('meta[name="csrf-token"]').content;

            // Validasi client-side sederhana
            if (this.users.some(user => !user.role || !user.email || !user.password)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Harap isi semua field yang wajib diisi!',
                });
                return;
            }

            // Kirim data ke server
            fetch('/dosen/create-user/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf_token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    users: this.users
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'User berhasil ditambahkan',
                        showConfirmButton: true,
                    });

                    this.createdUsers = data.created_users; 
                    this.showCreatedUsers = true;

                    this.$refs.userForm.reset();
                    this.users = [{
                        email: '',
                        password: '',
                        name: '',
                        nim: '',
                        prodi: null,
                        tanggal_lahir: null,
                        phone: null,
                        role: null,
                        showPassword: false
                    }];
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal menambahkan user',
                    text: error.message || 'Terjadi kesalahan server',
                });
            });
        },

        downloadTemplate() {
            const template = [
                {
                    email: 'example@email.com',
                    password: 'password123',
                    name: 'John Doe',
                    nim: 'XX/XXXXXX/AA/XXXXX',
                    prodi: 'nama prodi',
                    tanggal_lahir: 'YYYY-MM-DD',
                    phone: '12345678901 (10 sampai 12 digit)',
                    role: '1'
                }
            ];

            const ws = XLSX.utils.json_to_sheet(template);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Template");
            XLSX.writeFile(wb, "user_template.xlsx");
        },

        downloadExcel() {
            const filledUsers = this.users.map(user => {
            return {
                email: user.email || '-',
                password: user.password || '-',
                name: user.name || '-',
                nim: user.nim || '-',
                prodi: user.prodi || '-',
                tanggal_lahir: user.tanggal_lahir || '-',
                phone: user.phone || '-',
                Password: user.Password || '-',
                role: user.role || '-'
            };
            });
            const ws = XLSX.utils.json_to_sheet(filledUsers);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Full Users");
            XLSX.writeFile(wb, "full_users.xlsx");
        },

        submitExcel() {
            const file = this.selectedFile;

            if (!file) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Silakan pilih file Excel terlebih dahulu!',
                });
                return;
            }

            console.log('Preparing to submit file:', file.name); // Debug log

            const formData = new FormData();
            formData.append('file', file);
            // console.log('FormData created:', formData); // Debug log

            // Ngambil token CSRF dari meta tag
            const csrf_token = document.querySelector('meta[name="csrf-token"]').content;
            // console.log('CSRF Token:', csrf_token); // Debug log

            // Kirim file ke server
            fetch('/dosen/import-users', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf_token,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                console.log('Raw response:', response); // Debug raw response
                if (!response.ok) {
                    return response.json().then(err => {
                        console.error('Server error:', err); // Debug error
                        throw err;
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data); // Debug success
                if (data.status === 'success') {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Import berhasil!',
                        text: `Berhasil mengimpor ${data.imported_users.length} user`,
                        showConfirmButton: true,
                    });

                    this.createdUsers = data.imported_users;
                    this.showCreatedUsers = true;
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Import sebagian berhasil',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                console.error('Fetch error:', error); // Debug error
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengimport data',
                    text: error.message || 'Terjadi kesalahan saat mengimport data',
                });
            });
        }
    };
}

