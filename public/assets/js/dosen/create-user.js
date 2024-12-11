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
            role: 'role_1'
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
                role: 'role_1'
            });
        },

        removeUser(index) {
            this.users.splice(index, 1);
        },

        async submitForm() {
            // Validasi yang lebih ketat
            const isValid = this.users.every(user =>
                user.email &&
                user.password &&
                user.name &&
                user.nim &&
                user.role
            );

            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please fill all required fields for each user'
                });
                return;
            }

            try {
                // Pastikan payload sesuai dengan struktur yang diharapkan backend
                const payload = {
                    users: this.users.map(user => ({
                        email: user.email,
                        password: user.password,
                        name: user.name,
                        nim: user.nim,
                        prodi: user.prodi || null,
                        tanggal_lahir: user.tanggal_lahir || null,
                        phone: user.phone || null,
                        role: user.role
                    }))
                };

                const response = await fetch('/dosen/users', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                console.log(response)
                console.log(data);
                console.log(data.status);

                if (data.status === 'success') {
                    this.createdUsers = [...this.users];
                    this.showCreatedUsers = true;

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message
                    });

                    // Reset form after successful submission
                    this.users = [{
                        email: '',
                        password: '',
                        name: '',
                        nim: '',
                        prodi: null,
                        tanggal_lahir: null,
                        phone: null,
                        role: ''
                    }];
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: 'Failed to create users. Please try again.'
                });
            }
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
                    role: 'role_1'
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

