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
                showPassword: false
            });
        },

        removeUser(index) {
            this.users.splice(index, 1);
        },

        submitForm() {
            this.createdUsers = [...this.users];
            this.showCreatedUsers = true;
        },

        downloadTemplate() {
            const template = [
                {
                    email: 'example@email.com',
                    password: 'password123',
                    name: 'John Doe',
                    nim: '12345',
                    prodi: null,
                    tanggal_lahir: null,
                    phone: null
                }
            ];

            const ws = XLSX.utils.json_to_sheet(template);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Template");
            XLSX.writeFile(wb, "user_template.xlsx");
        },

        downloadExcel() {
            const ws = XLSX.utils.json_to_sheet(this.createdUsers);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Users");
            XLSX.writeFile(wb, "created_users.xlsx");
        },

        submitExcel() {
            // Handle Excel file submission
            const fileInput = this.$refs.fileInput;
            const file = fileInput.files[0];

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