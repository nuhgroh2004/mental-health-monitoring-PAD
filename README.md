# GamaPuls

Sistem Monitoring Kesehatan Mental untuk Mahasiswa Universitas Gadjah Mada

## Deskripsi

GamaPuls adalah aplikasi berbasis web yang dirancang untuk membantu mahasiswa memantau dan mengelola kesehatan mental mereka. Sistem ini memungkinkan mahasiswa untuk mencatat suasana hati (mood tracking), melacak kemajuan aktivitas harian (progress tracking), dan berkomunikasi dengan dosen pembimbing akademik mengenai kondisi kesehatan mental mereka.

## Fitur Utama

### Untuk Mahasiswa
- **Mood Tracking**: Mencatat tingkat emosi dan intensitas perasaan harian
- **Progress Tracking**: Memantau target yang diharapkan vs pencapaian aktual
- **Mood Calendar**: Visualisasi kalender untuk melihat riwayat mood bulanan
- **Notes Management**: Menambahkan catatan pribadi terkait kondisi emosional
- **Report Generation**: Membuat laporan kesehatan mental untuk dosen pembimbing
- **Notification System**: Menerima notifikasi terkait status laporan dan komunikasi dengan dosen
- **Profile Management**: Mengelola profil dan informasi pribadi

### Untuk Dosen
- **Dashboard Monitoring**: Melihat daftar mahasiswa bimbingan dan status kesehatan mental mereka
- **User Management**: Membuat akun mahasiswa secara manual atau melalui import Excel
- **Report Review**: Menerima dan meninjau laporan kesehatan mental dari mahasiswa
- **PDF Generation**: Mengunduh laporan mahasiswa dalam format PDF
- **Notification Management**: Mengelola notifikasi dan komunikasi dengan mahasiswa
- **Search & Filter**: Mencari mahasiswa berdasarkan kriteria tertentu
- **Profile Management**: Mengelola profil dosen

### Sistem Autentikasi
- Login dengan email dan password
- Registrasi terpisah untuk mahasiswa dan dosen
- Verifikasi OTP melalui email untuk akun dosen
- Role-based access control (Mahasiswa dan Dosen)
- Laravel Sanctum untuk API authentication

## Teknologi

### Backend
- **Framework**: Laravel 10
- **PHP**: ^8.1
- **Database**: MySQL
- **Authentication**: Laravel Sanctum
- **PDF Generation**: barryvdh/laravel-dompdf
- **Excel Processing**: phpoffice/phpspreadsheet
- **Email**: SMTP Gmail
- **Captcha**: anhskohbo/no-captcha (reCAPTCHA)

### Frontend
- **Template Engine**: Blade
- **CSS Framework**: Tailwind CSS
- **JavaScript Library**: Axios, SweetAlert2
- **Build Tool**: Vite

### Development Tools
- **Testing**: PHPUnit
- **Code Quality**: Laravel Pint
- **Container**: Laravel Sail (Docker)

## Persyaratan Sistem

- PHP >= 8.1
- Composer
- MySQL >= 5.7 atau MariaDB
- Node.js >= 16.x dan npm
- Web Server (Apache/Nginx)
- Extension PHP: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/nuhgroh2004/mental-health-monitoring-PAD.git
cd mental-health-monitoring-PAD
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Konfigurasi Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gamapulse
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Konfigurasi Email

Edit file `.env` untuk konfigurasi email (untuk OTP verification):

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME="your-email@gmail.com"
MAIL_PASSWORD="your-app-password"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 6. Konfigurasi reCAPTCHA

Dapatkan site key dan secret key dari [Google reCAPTCHA](https://www.google.com/recaptcha/admin), kemudian tambahkan ke `.env`:

```env
NOCAPTCHA_SITE_KEY=your-site-key
NOCAPTCHA_SECRET_KEY=your-secret-key
```

### 7. Migrasi Database

```bash
# Jalankan migrasi
php artisan migrate

# (Optional) Jalankan seeder jika ada
php artisan db:seed
```

### 8. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 9. Jalankan Aplikasi

```bash
# Jalankan development server
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Struktur Database

### Tabel Users
- `user_id` (Primary Key)
- `name`: Nama lengkap pengguna
- `email`: Email (unique)
- `password`: Password terenkripsi
- `role`: Enum (Mahasiswa, Dosen)

### Tabel Mahasiswa
- `mahasiswa_id` (Primary Key, Foreign Key ke users.user_id)
- `NIM`: Nomor Induk Mahasiswa (unique)
- `prodi`: Program Studi
- `tanggal_lahir`: Tanggal lahir
- `nomor_hp`: Nomor handphone
- `mahasiswa_role_id`: Foreign key ke mahasiswa_role

### Tabel Dosen
- `dosen_id` (Primary Key, Foreign Key ke users.user_id)
- `verified`: Status verifikasi (yes, no)

### Tabel Mahasiswa_Role
- `mahasiswa_role_id` (Primary Key)
- `name`: Nama role
- `min_intensity`: Intensitas minimum
- `max_intensity`: Intensitas maksimum

### Tabel Mood_Tracker
- `mood_id` (Primary Key)
- `mahasiswa_id`: Foreign key ke mahasiswa
- `mood_level`: Tingkat mood (1-5)
- `mood_intensity`: Intensitas mood
- `mood_note`: Catatan mood

### Tabel Progress_Tracking
- `progress_id` (Primary Key)
- `mahasiswa_id`: Foreign key ke mahasiswa
- `expected_target`: Target yang diharapkan
- `actual_target`: Target aktual yang dicapai
- `is_achieved`: Status pencapaian (boolean)
- `tracking_date`: Tanggal tracking

### Tabel Notifications
- `notification_id` (Primary Key)
- `dosen_id`: Foreign key ke dosen
- `mahasiswa_id`: Foreign key ke mahasiswa
- `progress_id`: Foreign key ke progress_tracking
- `mood_id`: Foreign key ke mood_tracker
- `request_status`: Enum (accepted, rejected, pending)
- `read_status`: Enum (read, unread)
- `accepted_at`: Timestamp ketika diterima

### Tabel OTP
- `otp_id` (Primary Key)
- `dosen_id`: Foreign key ke dosen
- `otp_code`: Kode OTP (4 digit)
- `verified`: Status verifikasi (yes, no)
- `is_expired`: Status kedaluwarsa (yes, no)
- `expired_at`: Timestamp kedaluwarsa

## API Endpoints

### Authentication
```
POST   /api/login                          - Login user
POST   /api/logout                         - Logout user (authenticated)
POST   /api/register/mahasiswa             - Registrasi mahasiswa
POST   /api/register/dosen                 - Registrasi dosen
```

### Mahasiswa Endpoints (Protected)
```
GET    /api/mahasiswa/profil               - Lihat profil mahasiswa
PUT    /api/mahasiswa/update-profil        - Update profil mahasiswa
GET    /api/mahasiswa/roles                - Lihat daftar role mahasiswa
POST   /api/mahasiswa/store-mood           - Simpan mood tracking
GET    /api/mahasiswa/mood-calendar        - Lihat kalender mood
POST   /api/mahasiswa/store-progress       - Simpan progress tracking
GET    /api/mahasiswa/report               - Lihat laporan
GET    /api/mahasiswa/notifikasi           - Lihat notifikasi
```

### Dosen Endpoints (Protected)
```
GET    /api/dosen/mahasiswa                - Lihat daftar mahasiswa
GET    /api/dosen/profil                   - Lihat profil dosen
PUT    /api/dosen/update-profil            - Update profil dosen
POST   /api/dosen/create-user              - Buat akun mahasiswa
GET    /api/dosen/notifikasi               - Lihat notifikasi
POST   /api/dosen/notifikasi/{id}/update   - Update status notifikasi
```

## Penggunaan

### Registrasi Mahasiswa
1. Akses halaman registrasi mahasiswa
2. Masukkan informasi: nama, email (@mail.ugm.ac.id), NIM, program studi, tanggal lahir, nomor HP
3. Pilih role mahasiswa sesuai kondisi
4. Klik tombol registrasi
5. Login dengan email dan password yang telah dibuat

### Registrasi Dosen
1. Akses halaman registrasi dosen
2. Masukkan informasi: nama, email (@ugm.ac.id), password
3. Sistem akan mengirimkan kode OTP ke email
4. Masukkan kode OTP untuk verifikasi
5. Setelah verifikasi berhasil, akun dosen aktif

### Mencatat Mood (Mahasiswa)
1. Login sebagai mahasiswa
2. Pilih emosi yang dirasakan (Marah, Sedih, Netral, Senang, Gembira)
3. Tentukan intensitas perasaan
4. Tambahkan catatan (opsional)
5. Simpan mood tracking

### Membuat Laporan (Mahasiswa)
1. Akses menu Report
2. Pilih periode laporan (bulan dan tahun)
3. Review data mood dan progress
4. Kirim laporan ke dosen pembimbing

### Mengelola Mahasiswa (Dosen)
1. Login sebagai dosen
2. Akses dashboard untuk melihat daftar mahasiswa
3. Pilih mahasiswa untuk melihat detail kondisi kesehatan mental
4. Review laporan yang dikirimkan mahasiswa
5. Terima atau tolak laporan melalui sistem notifikasi

### Import Data Mahasiswa (Dosen)
1. Siapkan file Excel dengan format yang sesuai
2. Akses menu Create User
3. Upload file Excel
4. Sistem akan memproses dan membuat akun mahasiswa secara otomatis

## Testing

```bash
# Menjalankan semua test
php artisan test

# Menjalankan test tertentu
php artisan test --filter TestName

# Menjalankan test dengan coverage
php artisan test --coverage
```

## Deployment

### Production Setup

1. Set environment ke production di `.env`:
```env
APP_ENV=production
APP_DEBUG=false
```

2. Optimize aplikasi:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

3. Set permission yang tepat:
```bash
chmod -R 755 storage bootstrap/cache
```

4. Build assets untuk production:
```bash
npm run build
```

## Keamanan

- Password di-hash menggunakan bcrypt
- Protection terhadap CSRF (Cross-Site Request Forgery)
- SQL Injection protection melalui Eloquent ORM
- XSS (Cross-Site Scripting) protection
- Rate limiting untuk API endpoints
- Email verification untuk dosen (OTP)
- Role-based access control
- reCAPTCHA protection untuk form registrasi

## Demo

Untuk melihat demo aplikasi GamaPuls, silakan tonton video berikut:

[Link Video Demo di YouTube](https://youtu.be/aC_SDalBh3o)

## Kontribusi

Kontribusi terhadap project ini sangat diterima. Silakan fork repository ini dan submit pull request untuk perubahan yang diusulkan.

### Guidelines
1. Fork repository
2. Buat branch untuk fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## Troubleshooting

### Error: SQLSTATE[HY000] [2002] Connection refused
Pastikan MySQL service sudah berjalan dan konfigurasi database di `.env` sudah benar.

### Error: npm run dev tidak berjalan
Pastikan Node.js dan npm sudah terinstall dengan versi yang sesuai.

### Error: Class not found
Jalankan `composer dump-autoload` untuk regenerate autoload files.

### Error: Email tidak terkirim
Periksa konfigurasi SMTP di `.env` dan pastikan "Less secure app access" diaktifkan atau gunakan App Password untuk Gmail.

### Error: Permission denied untuk storage
Jalankan `chmod -R 755 storage bootstrap/cache` untuk memberikan permission yang sesuai.

## Lisensi

Project ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk informasi lebih lanjut.

## Kontak

Untuk pertanyaan atau dukungan, silakan hubungi:

- Repository: [https://github.com/nuhgroh2004/mental-health-monitoring-PAD](https://github.com/nuhgroh2004/mental-health-monitoring-PAD)
- Email: support@gamapuls.ugm.ac.id

## Ucapan Terima Kasih

Terima kasih kepada:
- Tim pengembang Laravel
- Universitas Gadjah Mada
- Semua kontributor yang telah membantu pengembangan project ini

## Changelog

### Version 1.0.0
- Implementasi mood tracking untuk mahasiswa
- Implementasi progress tracking
- Sistem notifikasi antara mahasiswa dan dosen
- Dashboard monitoring untuk dosen
- User management dengan import Excel
- PDF report generation
- OTP verification untuk dosen
- API endpoints dengan Laravel Sanctum
- Responsive design dengan Tailwind CSS

---

Dikembangkan dengan dedikasi untuk mendukung kesehatan mental mahasiswa Universitas Gadjah Mada.
