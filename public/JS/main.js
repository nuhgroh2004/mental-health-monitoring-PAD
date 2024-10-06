// <<<<<<<<<<<<<<<<<<---------- NAVBAR 1 ---------------->>>>>>>>>>>>>>>>>>>> //
const loginBtn = document.getElementById('loginBtn');
const registerBtn = document.getElementById('registerBtn');
const slider = document.getElementById('slider');

// <<<<--- ANIMASI SLAIDER LOGIN DAN REGISTER --->>> //
// Inisialisasi posisi slider saat halaman dimuat
window.onload = () => {
    slider.style.left = '3px'; // Set slider ke posisi login secara default
    loginBtn.classList.add('active'); // Tandai tombol login sebagai aktif
};

// Pindahkan slider ke posisi login
loginBtn.addEventListener('click', () => {
    slider.style.left = '3px'; // Pindahkan slider ke posisi login
    loginBtn.classList.add('active'); // Tandai tombol login sebagai aktif
    registerBtn.classList.remove('active'); // Hapus status aktif dari tombol register
});

// Pindahkan slider ke posisi register
registerBtn.addEventListener('click', () => {
    slider.style.left = '105px'; // Pindahkan slider ke posisi register
    registerBtn.classList.add('active'); // Tandai tombol register sebagai aktif
    loginBtn.classList.remove('active'); // Hapus status aktif dari tombol login
});
// <<<<--- ANIMASI SLAIDER LOGIN DAN REGISTER --->>> //


// <<<<--- ANIMASI DROP MENU REGISTER --->>> //
const dropdownMenu = document.getElementById('dropdownMenu');

// Toggle visibilitas dropdown menu saat tombol register diklik
registerBtn.addEventListener('click', () => {
    dropdownMenu.classList.toggle('show'); // Toggle kelas 'show' untuk menampilkan atau menyembunyikan dropdown
});

// Tutup dropdown jika mengklik di luar menu
window.addEventListener('click', function(e) {
    if (!registerBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.classList.remove('show'); // Hapus kelas 'show' untuk menyembunyikan dropdown
    }
});
// <<<<--- ANIMASI DROP MENU REGISTER --->>> //


// <<<<<<<<<<<<<<<<<<---------- animasi drop menu form login ---------------->>>>>>>>>>>>>>>>>>>> //
// Menggunakan jQuery untuk mengatur animasi dropdown di form login
$(document).ready(function() {
    // Toggle dropdown saat tautan 'Create Account' diklik
    $('#create-account-link').click(function(event) {
        event.preventDefault(); // Mencegah link melakukan navigasi
        $('#account-options').toggleClass('hidden'); // Toggle kelas 'hidden' untuk menampilkan atau menyembunyikan dropdown
    });
});
// <<<<<<<<<<<<<<<<<<---------- animasi drop menu form login ---------------->>>>>>>>>>>>>>>>>>>> //


// <<<<<<<<<<<<<<<<<<---------- animasi section 2 landing page ---------------->>>>>>>>>>>>>>>>>>>> //
// Menggunakan Intersection Observer untuk animasi elemen saat masuk ke viewport
document.addEventListener('DOMContentLoaded', (event) => {
    const animatedElements = document.querySelectorAll('[data-animate]'); // Pilih elemen dengan atribut 'data-animate'

    // Buat observer untuk memantau elemen saat masuk ke viewport
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove('opacity-0', 'translate-y-4'); // Hapus kelas untuk memulai animasi
                observer.unobserve(entry.target); // Hentikan pengamatan untuk elemen yang sudah di-animate
            }
        });
    }, { threshold: 0.1 }); // Memulai animasi saat 10% elemen masuk ke viewport

    // Mulai mengamati setiap elemen dengan 'data-animate'
    animatedElements.forEach(el => observer.observe(el));
});
// <<<<<<<<<<<<<<<<<<---------- animasi section 2 landing page ---------------->>>>>>>>>>>>>>>>>>>> //
