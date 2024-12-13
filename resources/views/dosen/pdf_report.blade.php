<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2 {
            color: #333;
        }
        .content {
            margin-top: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table th, .table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Laporan Mood dan Progress Mahasiswa</h1>
    <h2>Nama: {{ $name }}</h2>
    <h2>NIM: {{ $nim }}</h2>

    <div class="content">
        <h3>Riwayat Mood dan Progress (90 Hari Terakhir)</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Mood Level</th>
                    <th>Mood Intensity</th>
                    <th>Expected Target</th>
                    <th>Actual Target</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($moodProgressData as $data)
                    <tr>
                        <td>{{ $data['date'] }}</td>
                        <td>{{ $data['mood_level'] }}</td>
                        <td>{{ $data['mood_intensity'] }}</td>
                        <td>{{ $data['expected_target'] }}</td>
                        <td>{{ $data['actual_target'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
