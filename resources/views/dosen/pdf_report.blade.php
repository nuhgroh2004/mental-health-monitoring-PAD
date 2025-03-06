<!-- filepath: /c:/mental-health-monitoring-PAD/resources/views/dosen/pdf_report.blade.php -->
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.5;
        }
        h1, h2, h3 {
            color: #2c3e50;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }
        .content {
            margin-top: 20px;
        }
        .summary-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .summary-box {
            width: 30%;
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .summary-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #3498db;
        }
        .summary-value {
            font-size: 24px;
            font-weight: bold;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .table th, .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table th {
            background-color: #3498db;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table tr:hover {
            background-color: #e9f7fe;
        }
        .mood-indicator {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }
        .mood-1 {
            background-color: #e74c3c; /* Sangat buruk */
        }
        .mood-2 {
            background-color: #e67e22; /* Buruk */
        }
        .mood-3 {
            background-color: #f1c40f; /* Sedang */
        }
        .mood-4 {
            background-color: #2ecc71; /* Baik */
        }
        .mood-5 {
            background-color: #27ae60; /* Sangat baik */
        }
        .progress-bar {
            width: 100%;
            background-color: #f1f1f1;
            border-radius: 3px;
            margin-top: 5px;
        }
        .progress-fill {
            height: 10px;
            background-color: #3498db;
            border-radius: 3px;
        }
        .section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .chart-container {
            height: 200px;
            margin-top: 20px;
            position: relative;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .bar {
            position: absolute;
            bottom: 0;
            width: 30px;
            background-color: #3498db;
            transition: height 0.3s;
        }
        .bar-label {
            position: absolute;
            bottom: -25px;
            text-align: center;
            width: 30px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Mood dan Progress Mahasiswa</h1>
        <h2>Nama: {{ $name }}</h2>
        <h2>NIM: {{ $nim }}</h2>
    </div>

    <div class="content">
        <div class="section">
            <h3>Ringkasan</h3>
            <div class="summary-container">
                <div class="summary-box">
                    <div class="summary-title">Rata-rata Mood</div>
                    <div class="summary-value">
                        @php
                            $totalMood = 0;
                            $countMood = 0;
                            foreach ($moodProgressData as $data) {
                                if (isset($data['mood_level']) && $data['mood_level'] > 0) {
                                    $totalMood += $data['mood_level'];
                                    $countMood++;
                                }
                            }
                            $avgMood = $countMood > 0 ? round($totalMood / $countMood, 2) : 0;
                        @endphp
                        {{ $avgMood }} / 5
                    </div>
                    <div class="mood-indicator mood-{{ round($avgMood) }}"></div>
                </div>
                <div class="summary-box">
                    <div class="summary-title">Rata-rata Progres</div>
                    <div class="summary-value">
                        @php
                            $totalExpected = 0;
                            $totalActual = 0;
                            foreach ($moodProgressData as $data) {
                                if (isset($data['expected_target']) && isset($data['actual_target'])) {
                                    $totalExpected += $data['expected_target'];
                                    $totalActual += $data['actual_target'];
                                }
                            }
                            $progressPercentage = $totalExpected > 0 ? round(($totalActual / $totalExpected) * 100, 2) : 0;
                        @endphp
                        {{ $progressPercentage }}%
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $progressPercentage }}%"></div>
                    </div>
                </div>
                <div class="summary-box">
                    <div class="summary-title">Total Hari Tercatat</div>
                    <div class="summary-value">{{ count($moodProgressData) }}</div>
                </div>
            </div>
        </div>

        <div class="section">
            <h3>Tren Mood (7 Hari Terakhir)</h3>
            <div class="chart-container">
                @php
                    // Mengonversi Collection menjadi array jika perlu
                    $dataArray = $moodProgressData instanceof \Illuminate\Support\Collection ? 
                                $moodProgressData->toArray() : $moodProgressData;
                    $recentData = array_slice($dataArray, 0, 7);
                    $maxMoodLevel = 5;
                @endphp
                
                @foreach ($recentData as $index => $data)
                    @php
                        $height = isset($data['mood_level']) ? ($data['mood_level'] / $maxMoodLevel) * 150 : 0;
                        $left = 20 + ($index * 40);
                        $date = date('d/m', strtotime($data['date']));
                        $color = '';
                        if (isset($data['mood_level'])) {
                            switch ($data['mood_level']) {
                                case 1: $color = '#e74c3c'; break;
                                case 2: $color = '#e67e22'; break;
                                case 3: $color = '#f1c40f'; break;
                                case 4: $color = '#2ecc71'; break;
                                case 5: $color = '#27ae60'; break;
                                default: $color = '#3498db';
                            }
                        }
                    @endphp
                    
                    <div class="bar" style="height: {{ $height }}px; left: {{ $left }}px; background-color: {{ $color }}">
                    </div>
                    <div class="bar-label" style="left: {{ $left }}px">{{ $date }}</div>
                @endforeach
            </div>
        </div>

        <div class="section">
            <h3>Tren Progress (7 Hari Terakhir)</h3>
            <div class="chart-container">
                @php
                    // Mengonversi Collection menjadi array jika perlu
                    $dataArray = $moodProgressData instanceof \Illuminate\Support\Collection ? 
                                $moodProgressData->toArray() : $moodProgressData;
                    $recentData = array_slice($dataArray, 0, 7);
                    $maxProgress = 100;
                @endphp
                
                @foreach ($recentData as $index => $data)
                    @php
                        $percentage = isset($data['expected_target']) && $data['expected_target'] > 0 ? 
                            min(100, ($data['actual_target'] / $data['expected_target']) * 100) : 0;
                        $height = ($percentage / $maxProgress) * 150;
                        $left = 20 + ($index * 40);
                        $date = date('d/m', strtotime($data['date']));
                    @endphp
                    
                    <div class="bar" style="height: {{ $height }}px; left: {{ $left }}px;">
                    </div>
                    <div class="bar-label" style="left: {{ $left }}px">{{ $date }}</div>
                @endforeach
            </div>
        </div>

        <div class="section">
            <h3>Riwayat Mood dan Progress (90 Hari Terakhir)</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Mood Level</th>
                        <th>Mood Intensity</th>
                        <th>Expected Target (jam)</th>
                        <th>Actual Target (jam)</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($moodProgressData as $data)
                        <tr>
                            <td>{{ $data['date'] }}</td>
                            <td>
                                @if (isset($data['mood_level']))
                                    <span class="mood-indicator mood-{{ $data['mood_level'] }}"></span>
                                    {{ $data['mood_level'] }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ isset($data['mood_intensity']) ? $data['mood_intensity'] : '-' }}</td>
                            <td>{{ isset($data['expected_target']) ? round($data['expected_target']/3600, 2) : '-' }}</td>
                            <td>{{ isset($data['actual_target']) ? round($data['actual_target']/3600, 2) : '-' }}</td>
                            <td>
                                @if (isset($data['expected_target']) && $data['expected_target'] > 0)
                                    @php
                                        $progressPercentage = min(100, ($data['actual_target'] / $data['expected_target']) * 100);
                                    @endphp
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: {{ $progressPercentage }}%"></div>
                                    </div>
                                    {{ round($progressPercentage, 2) }}%
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>