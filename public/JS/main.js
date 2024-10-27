
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

// <<<<<<<<<<<<<<<<<<---------- captha generator ---------------->>>>>>>>>>>>>>>>>>>> //
document.addEventListener('DOMContentLoaded', function () {
    const captchaTable = document.getElementById('captchaTable');
    const captchaInput = document.getElementById('captchaInput');
    const refreshButton = document.getElementById('refreshButton');

    // Generate the initial Captcha
    generateCaptchaTable();

    // Event listener for the Refresh button
    refreshButton.addEventListener('click', function () {
        generateCaptchaTable();
        captchaInput.value = ''; // Clear input on refresh
    });

    // Function to generate a random string for the Captcha (only numbers, now 4 digits)
    function generateRandomString(length) {
        const characters = '0123456789'; // Use only numbers
        let result = '';
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }

    // Function to generate the Captcha table
    function generateCaptchaTable() {
        const captchaText = generateRandomString(4); // Now only 4 digits
        captchaTable.dataset.captcha = captchaText;
        captchaTable.innerHTML = ''; // Clear the current CAPTCHA

        // Create a container div for positioning (with rounded corners)
        const captchaWrapper = document.createElement('div');
        captchaWrapper.classList.add('relative', 'w-full', 'h-16', 'bg-gray-200', 'flex', 'items-center', 'justify-center', 'rounded-lg', 'overflow-hidden'); // Added 'rounded-lg' for rounded corners

        // Create each character div and append to wrapper
        for (let i = 0; i < captchaText.length; i++) {
            const cell = document.createElement('div');
            cell.textContent = captchaText.charAt(i); // Display each character of CAPTCHA
            cell.classList.add('text-3xl', 'font-bold', 'w-10', 'h-10', 'text-center', 'text-black', 'relative', 'z-10', 'mx-1'); // Smaller font size and spacing

            captchaWrapper.appendChild(cell);
        }

        captchaTable.appendChild(captchaWrapper); // Append wrapper to captchaTable

        // Create a canvas for drawing lines (on top of the numbers)
        const canvas = document.createElement('canvas');
        canvas.width = 300; // Adjust width to fit 4 digits
        canvas.height = 70;  // Adjust height to be proportional
        const ctx = canvas.getContext('2d');
        drawRandomLines(ctx, canvas.width, canvas.height); // Call the function to draw random lines

        // Set canvas to be positioned above the text (using z-index)
        canvas.classList.add('absolute', 'top-0', 'left-0', 'z-20'); // Ensure canvas is above the digits

        captchaWrapper.appendChild(canvas); // Append canvas over the digits
    }

    // Function to draw random lines over the CAPTCHA (with fewer lines)
    function drawRandomLines(ctx, width, height) {
        ctx.strokeStyle = 'black';
        ctx.lineWidth = 1.5; // Slightly thinner lines

        // Adjust random positions to stay within bounds
        function getRandomPosition(min, max) {
            return Math.random() * (max - min) + min;
        }

        // Draw 3 random straight lines (reduce the number of lines)
        for (let i = 0; i < 3; i++) {
            ctx.beginPath();
            const startX = getRandomPosition(10, width - 10); // Prevent starting near the edges
            const startY = getRandomPosition(10, height - 10);
            const endX = getRandomPosition(10, width - 10);
            const endY = getRandomPosition(10, height - 10);
            ctx.moveTo(startX, startY); // Random start point
            ctx.lineTo(endX, endY); // Random end point
            ctx.stroke();
        }

        // Draw 2 additional scribble-like curves (reduce number of curves)
        for (let i = 0; i < 2; i++) {
            ctx.beginPath();
            let startX = getRandomPosition(10, width - 10);
            let startY = getRandomPosition(10, height - 10);
            ctx.moveTo(startX, startY);
            for (let j = 0; j < 3; j++) {
                const cpX = getRandomPosition(10, width - 10); // Control point within bounds
                const cpY = getRandomPosition(10, height - 10);
                const endX = getRandomPosition(10, width - 10);
                const endY = getRandomPosition(10, height - 10);
                ctx.quadraticCurveTo(cpX, cpY, endX, endY);
            }
            ctx.stroke();
        }
    }
});
// <<<<<<<<<<<<<<<<<<---------- captha generator ---------------->>>>>>>>>>>>>>>>>>>> //


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
