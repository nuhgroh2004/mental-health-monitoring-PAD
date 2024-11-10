
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

sssssssssss 

// <<<<<<<<<<<<<<<<<<---------- animasi refseres register ---------------->>>>>>>>>>>>>>>>>>>> //
const refreshButton = document.getElementById("refreshButton");
const refreshIcon = document.getElementById("refreshIcon");

refreshButton.addEventListener("click", () => {
    refreshIcon.classList.add("rotate");

    // Remove the class after animation to allow repeating the animation on next click
    setTimeout(() => {
        refreshIcon.classList.remove("rotate");
    }, 500);
});
// <<<<<<<<<<<<<<<<<<---------- animasi refseres register ---------------->>>>>>>>>>>>>>>>>>>> //

// <<<<<<<<<<<<<<<<<<---------- melihat password register ---------------->>>>>>>>>>>>>>>>>>>> //
const passwordInput = document.getElementById('password');
const togglePasswordButton = document.getElementById('togglePassword');
const eyeClosedIcon = document.getElementById('eyeClosed');
const eyeOpenIcon = document.getElementById('eyeOpen');

// Atur kondisi awal
let isPasswordHidden = true; // Password tersembunyi di awal

togglePasswordButton.addEventListener('click', function () {
    // Toggle the type attribute between 'password' and 'text'
    isPasswordHidden = !isPasswordHidden;
    passwordInput.type = isPasswordHidden ? 'password' : 'text';

    // Toggle icon visibility
    eyeClosedIcon.classList.toggle('hidden', !isPasswordHidden);
    eyeOpenIcon.classList.toggle('hidden', isPasswordHidden);
});
// <<<<<<<<<<<<<<<<<<---------- melihat password register ---------------->>>>>>>>>>>>>>>>>>>> //
