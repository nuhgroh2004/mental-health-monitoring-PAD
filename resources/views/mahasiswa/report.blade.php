@extends('navbar/navbar3')
@section('content')

<!-- resources/views/laporan-mood-tugas-akhir.blade.php -->

    <title>Laporan Mood dan Tugas Akhir</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<div class="bg-[#76aeb8] min-h-screen py-5 px-10 ">
    <div class="w-[100%] mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden opacity-0" id="mainContainer">
            <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-center py-4 bg-[#479cab] text-white">Laporan <span id="reportTypeTitle">Bulanan</span></h1>

            <div class="p-4">
                <div class="flex mb-4">
                    <button onclick="showTab('mood')" class="flex-1 py-2 px-4 text-center text-sm sm:text-base bg-[#76aeb8] text-white" id="moodTab">Mood</button>
                    <button onclick="showTab('tugas')" class="flex-1 py-2 px-4 text-center text-sm sm:text-base bg-gray-200 text-black" id="tugasTab">Pengerjaan tugas akhir</button>
                </div>

                <div class="h-48 sm:h-64 md:h-80">
                    <canvas id="chart"></canvas>
                </div>
            </div>

            <div class="p-4 space-y-4 sm:space-y-0 sm:flex sm:space-x-4">
                <div class="w-full sm:w-1/3">
                    <select id="reportType" class="w-full p-2 border rounded bg-white text-[#76aeb8] text-sm sm:text-base transition-all duration-300" onchange="updateReportType()">
                        <option value="monthly">Bulanan</option>
                        <option value="weekly">Mingguan</option>
                    </select>
                </div>
                <div class="w-full sm:w-1/3">
                    <select id="selectedMonth" class="w-full p-2 border rounded bg-white text-[#76aeb8] text-sm sm:text-base transition-all duration-300" onchange="updatePeriod()">
                        @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
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

    <script>
        let currentTab = 'mood';
        let currentReportType = 'monthly';
        let chart;

        const moodData = {
            monthly: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [
                    { label: 'Senang', data: [20, 23, 25, 22, 26, 23], backgroundColor: '#4dd0e1' },
                    { label: 'Sedih', data: [5, 3, 4, 3, 2, 4], backgroundColor: '#f48fb1' },
                    { label: 'Marah', data: [2, 3, 1, 4, 2, 1], backgroundColor: '#ffcc80' },
                    { label: 'Biasa Saja', data: [15, 14, 14, 15, 13, 16], backgroundColor: '#fff59d' }
                ]
            },
            weekly: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [
                    { label: 'Senang', data: [5, 6, 4, 7, 5, 6, 5], backgroundColor: '#4dd0e1' },
                    { label: 'Sedih', data: [1, 0, 2, 1, 0, 1, 0], backgroundColor: '#f48fb1' },
                    { label: 'Marah', data: [0, 1, 0, 0, 1, 0, 1], backgroundColor: '#ffcc80' },
                    { label: 'Biasa Saja', data: [2, 1, 2, 0, 2, 1, 2], backgroundColor: '#fff59d' }
                ]
            }
        };

        const tugasData = {
            monthly: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [
                    { label: 'Target (jam)', data: [20, 40, 60, 80, 100, 120], backgroundColor: 'rgba(76, 175, 80, 0.6)' },
                    { label: 'Tercapai (jam)', data: [15, 35, 55, 70, 90, 110], backgroundColor: 'rgba(33, 150, 243, 0.6)' }
                ]
            },
            weekly: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [
                    { label: 'Target (jam)', data: [4, 4, 4, 4, 4, 2, 2], backgroundColor: 'rgba(76, 175, 80, 0.6)' },
                    { label: 'Tercapai (jam)', data: [3, 4, 3, 5, 4, 1, 2], backgroundColor: 'rgba(33, 150, 243, 0.6)' }
                ]
            }
        };

        function showTab(tab) {
            currentTab = tab;
            const moodTab = document.getElementById('moodTab');
            const tugasTab = document.getElementById('tugasTab');

            if (tab === 'mood') {
                moodTab.classList.remove('bg-gray-200', 'text-black');
                moodTab.classList.add('bg-[#76aeb8]', 'text-white');
                tugasTab.classList.remove('bg-[#76aeb8]', 'text-white');
                tugasTab.classList.add('bg-gray-200', 'text-black');
            } else {
                tugasTab.classList.remove('bg-gray-200', 'text-black');
                tugasTab.classList.add('bg-[#76aeb8]', 'text-white');
                moodTab.classList.remove('bg-[#76aeb8]', 'text-white');
                moodTab.classList.add('bg-gray-200', 'text-black');
            }

            updateChart();
        }

        function updateReportType() {
            currentReportType = document.getElementById('reportType').value;
            document.getElementById('reportTypeTitle').textContent = currentReportType === 'monthly' ? 'Bulanan' : 'Mingguan';
            document.getElementById('weekContainer').classList.toggle('hidden', currentReportType === 'monthly');
            updateChart();
        }

        function updatePeriod() {
            updateChart();
        }

        function updateChart() {
            const ctx = document.getElementById('chart').getContext('2d');

            if (chart) {
                chart.destroy();
            }

            const data = currentTab === 'mood' ? moodData[currentReportType] : tugasData[currentReportType];

            const chartConfig = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: currentTab === 'mood' ? 'Grafik Mood' : 'Progress Tugas Akhir'
                        }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            };

            chart = new Chart(ctx, chartConfig);
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateReportType();
            updateChart();

            // Fade in animation for the main container
            anime({
                targets: '#mainContainer',
                opacity: [0, 1],
                translateY: [20, 0],
                duration: 1000,
                easing: 'easeOutQuad'
            });


            // Select element animation
            const selects = document.querySelectorAll('select');
            selects.forEach(select => {
                select.addEventListener('focus', () => {
                    anime({
                        targets: select,
                        boxShadow: '0 0 0 3px rgba(118, 174, 184, 0.3)',
                        duration: 300,
                        easing: 'easeOutQuad'
                    });
                });
                select.addEventListener('blur', () => {
                    anime({
                        targets: select,
                        boxShadow: '0 0 0 0 rgba(118, 174, 184, 0)',
                        duration: 300,
                        easing: 'easeOutQuad'
                    });
                });
            });
        });

        window.addEventListener('resize', () => {
            if (chart) {
                chart.resize();
            }
        });
    </script>
@endsection
