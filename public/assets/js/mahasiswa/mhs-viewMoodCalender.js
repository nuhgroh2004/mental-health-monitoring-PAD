
const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
let currentDate = new Date(2024, 10, 1); // November 2024

function updateCalendar() {
    const monthYear = `${months[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
    document.getElementById('currentMonth').textContent = monthYear;

    console.log(`Fetching mood data for ${monthYear}`);
}

document.getElementById('prevMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    updateCalendar();
});

document.getElementById('nextMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    updateCalendar();
});

function showMoodDetails(day) {
    console.log(`Show mood details for day ${day}`);
}

updateCalendar();
