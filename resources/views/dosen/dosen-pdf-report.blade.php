<!-- filepath: /c:/mental-health-monitoring-PAD/resources/views/dosen/pdf_report.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Mood dan Progress</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Laporan Mood dan Progress</h1>
    <h2>{{ $name }} ({{ $nim }})</h2>

    <canvas id="averageMoodChart"></canvas>
    <canvas id="firstMonthMoodChart"></canvas>
    <canvas id="secondMonthMoodChart"></canvas>
    <canvas id="thirdMonthMoodChart"></canvas>
    <canvas id="firstMonthProgressChart"></canvas>
    <canvas id="secondMonthProgressChart"></canvas>
    <canvas id="thirdMonthProgressChart"></canvas>

    <script>
        const moodProgressData = @json($moodProgressData);

        // Function to create chart
        function createChart(ctx, labels, data, label) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Example data processing (you need to adjust this based on your actual data structure)
        const labels = moodProgressData.map(item => item.date);
        const averageMoodData = moodProgressData.map(item => item.averageMood);
        const firstMonthMoodData = moodProgressData.slice(0, 30).map(item => item.mood);
        const secondMonthMoodData = moodProgressData.slice(30, 60).map(item => item.mood);
        const thirdMonthMoodData = moodProgressData.slice(60, 90).map(item => item.mood);
        const firstMonthProgressData = moodProgressData.slice(0, 30).map(item => item.progress);
        const secondMonthProgressData = moodProgressData.slice(30, 60).map(item => item.progress);
        const thirdMonthProgressData = moodProgressData.slice(60, 90).map(item => item.progress);

        // Create charts
        createChart(document.getElementById('averageMoodChart').getContext('2d'), labels, averageMoodData, 'Rata-rata Mood 90 Hari');
        createChart(document.getElementById('firstMonthMoodChart').getContext('2d'), labels.slice(0, 30), firstMonthMoodData, 'Mood Bulan Pertama');
        createChart(document.getElementById('secondMonthMoodChart').getContext('2d'), labels.slice(30, 60), secondMonthMoodData, 'Mood Bulan Kedua');
        createChart(document.getElementById('thirdMonthMoodChart').getContext('2d'), labels.slice(60, 90), thirdMonthMoodData, 'Mood Bulan Ketiga');
        createChart(document.getElementById('firstMonthProgressChart').getContext('2d'), labels.slice(0, 30), firstMonthProgressData, 'Pengerjaan Tugas Akhir Bulan Pertama');
        createChart(document.getElementById('secondMonthProgressChart').getContext('2d'), labels.slice(30, 60), secondMonthProgressData, 'Pengerjaan Tugas Akhir Bulan Kedua');
        createChart(document.getElementById('thirdMonthProgressChart').getContext('2d'), labels.slice(60, 90), thirdMonthProgressData, 'Pengerjaan Tugas Akhir Bulan Ketiga');
    </script>
</body>
</html>