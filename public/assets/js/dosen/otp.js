document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.otp-input');
    inputs.forEach((input, index) => {
        input.addEventListener('input', function () {
            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });
});

let timeLeft = 60;
const timerElement = document.getElementById('timer');
const resendButton = document.getElementById('resendOtp');

const countdown = setInterval(() => {
    timeLeft--;
    timerElement.textContent = timeLeft;

    if (timeLeft === 0) {
        clearInterval(countdown);
        resendButton.disabled = false;
    }
}, 1000);

function increaseFontSize() {
    timerElement.style.fontSize = '2rem';
}

document.addEventListener('DOMContentLoaded', increaseFontSize);

resendButton.addEventListener('click', function () {
    timeLeft = 60;
    timerElement.textContent = timeLeft;
    resendButton.disabled = true;
    const newCountdown = setInterval(() => {
        timeLeft--;
        timerElement.textContent = timeLeft;

        if (timeLeft === 0) {
            clearInterval(newCountdown);
            resendButton.disabled = false;
        }
    }, 1000);
});
