function createUserForm() {
    return {
        users: [{
            email: '',
            password: '',
            name: '',
            nim: '',
            prodi: null,
            tanggal_lahir: null,
            phone: null,
            Password: '',
            role: null, // Diubah dari string kosong ke null
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
                role: null, // Diubah dari string kosong ke null
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
                    phone: '1234567890',
                    role: 'role 1'
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
            // Handle Excel file submission
            const fileInput = this.$refs.fileInput;
            const file = fileInput.files[0];

            function submitExcel(){
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Your work has been saved",
                    showConfirmButton: false,
                    timer: 1500
                  });

            }


            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, { type: 'array' });
                    const sheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[sheetName];
                    const jsonData = XLSX.utils.sheet_to_json(worksheet);

                    this.createdUsers = jsonData.map(user => ({
                        ...user,
                        prodi: user.prodi || null,
                        tanggal_lahir: user.tanggal_lahir || null,
                        phone: user.phone || null
                    }));

                    this.showCreatedUsers = true;
                    this.excelCreationSuccess = true;
                    setTimeout(() => {
                        this.excelCreationSuccess = false;
                    }, 3000);
                };
                reader.readAsArrayBuffer(file);
            }
        }
    };
}

