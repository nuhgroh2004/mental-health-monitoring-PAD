<!-- filepath: /c:/mental-health-monitoring-PAD/resources/views/mahasiswa/report.blade.php -->
@extends('navbar/navbar-mahasiswa')
@section('content')

<title>Laporan Mood dan Tugas Akhir</title>

<div class="bg-white min-h-screen py-5 px-2" style="display: block;">
    <div class="container-card mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden opacity-100 " id="mainContainer">
            <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-center py-4 bg-[#479cab] text-white">Laporan <span id="reportTypeTitle">Bulanan</span></h1>

            <div class="p-4">
                <div class="flex mb-4">
                    <button onclick="showTab('mood')" class="flex-1 py-2 px-4 text-center text-sm sm:text-base bg-[#76aeb8] text-white" id="moodTab">Mood</button>
                    <button onclick="showTab('tugas')" class="flex-1 py-2 px-4 text-center text-sm sm:text-base bg-gray-200 text-black" id="tugasTab">Pengerjaan tugas</button>
                </div>

                <div class="h-[350px] sm:h-[400px]">
                    <canvas id="chart"></canvas>
                </div>
            </div>
            <div>
                <div class="p-4 space-y-4 sm:space-y-0 sm:flex sm:space-x-4">
                    <div class="w-full sm:w-1/3">
                        <select id="reportType" class="w-full p-2 border rounded bg-white text-[#76aeb8] text-sm sm:text-base transition-all duration-300" onchange="updateReportType()">
                            <option value="monthly">Bulanan</option>
                            <option value="weekly">Mingguan</option>
                        </select>
                    </div>
                    <div class="w-full sm:w-1/3">
                        <select id="selectedMonth" class="w-full p-2 border rounded bg-white text-[#76aeb8] text-sm sm:text-base transition-all duration-300" onchange="updatePeriod()">
                            @foreach ($months as $month)
                                <option value="{{ $month['value'] }}" {{ request()->input('month') == $month['value'] ? 'selected' : '' }}>{{ $month['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="weekContainer" class="w-full sm:w-1/3 hidden">
                        <select id="selectedWeek" class="w-full p-2 border rounded bg-white text-[#76aeb8] text-sm sm:text-base transition-all duration-300" onchange="updateChart()">
                            <option value="1">Minggu ke-1</option>
                            <option value="2">Minggu ke-2</option>
                            <option value="3">Minggu ke-3</option>
                            <option value="4">Minggu ke-4</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan canvas baru untuk grafik rata-rata mood all time -->
    <div class="container-card mx-auto mt-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden opacity-100 p-4">
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-center py-4 bg-[#479cab] text-white">Rata-rata Mood</h2>
            <div class="h-[350px] sm:h-[400px]">
                <canvas id="averageMoodChart"></canvas>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartData = @json($chartData);
    const averageMood = @json($averageMood);

    const selectMonth = document.getElementById('selectedMonth');

    selectMonth.addEventListener('change', function() {
        const month = this.value; // Sudah berupa angka dari value select
        const year = {{ $year }};

        // Update grafik dan jumlah tanggal
        updatePeriod();

        // Ubah URL param
        window.location.href = `{{ route('mahasiswa.report') }}?month=${month}&year=${year}`;

    });

    function updateAverageMoodChart() {
        const ctx = document.getElementById('averageMoodChart').getContext('2d');

        const data = {
            labels: ['Marah %', 'Sedih %', 'Biasa %', 'Senang %', 'Tidak Mengisi %'],
            datasets: [{
                label: '',
                data: [averageMood[1], averageMood[2], averageMood[3], averageMood[4], averageMood['unknown']],
                backgroundColor: ['#e57373', '#ffb74d', '#fff59d', '#81c784', '#cfd8dc'],
                borderColor: ['#e57373', '#ffb74d', '#fff59d', '#81c784', '#cfd8dc'],
                borderWidth: 1
            }]
        };

        const chartConfig = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Rata-rata Mood All Time (%)',
                        font: {
                            size: 16
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Persentase Mood (%)'
                        },
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        };

        new Chart(ctx, chartConfig);
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateChart();
        updateAverageMoodChart();
    });

    window.addEventListener('resize', () => {
        if (chart) {
            chart.resize();
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script src="{{ asset('assets/js/mahasiswa/mhs-report.js') }}"></script>
@endsection