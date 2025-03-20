<?php

namespace App\Http\Controllers\Api\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\MoodTracker;
use App\Models\ProgressTracker;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getReportData(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));
        $mahasiswaId = auth()->user()->user_id;

        // Ambil data mood untuk bulan & tahun yang dipilih
        $moodData = MoodTracker::where('mahasiswa_id', $mahasiswaId)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get()
            ->map(function ($mood) {
                return [
                    'day' => Carbon::parse($mood->created_at)->day,
                    'mood_level' => $mood->mood_level,
                    'mood_intensity' => $mood->mood_intensity,
                    'mood_note' => $mood->mood_note
                ];
            })
            ->keyBy('day');

        // Ambil data progress untuk bulan & tahun yang dipilih
        $progressData = ProgressTracker::where('mahasiswa_id', $mahasiswaId)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get()
            ->map(function ($progress) {
                return [
                    'day' => Carbon::parse($progress->created_at)->day,
                    'expected_target' => $progress->expected_target / 3600, // dalam jam
                    'actual_target' => $progress->actual_target / 3600, // dalam jam
                    'is_achieved' => $progress->is_achieved
                ];
            })
            ->keyBy('day');

        // Siapkan data untuk chart
        $chartData = $this->prepareChartData($moodData, $progressData, $month, $year);

        // Hitung rata-rata mood keseluruhan
        $averageMood = $this->calculateAverageMood($mahasiswaId);

        return response()->json([
            'success' => true,
            'chartData' => $chartData,
            'averageMood' => $averageMood
        ]);
    }

    // Tambahkan private agar bisa diakses di dalam controller ini
private function prepareChartData($moodData, $progressData, $month, $year)
{
    $daysInMonth = Carbon::create($year, $month)->daysInMonth;
    $chartData = [];

    for ($day = 1; $day <= $daysInMonth; $day++) {
        $mood = $moodData[$day] ?? null;
        $progress = $progressData[$day] ?? null;

        $chartData['mood'][$day] = [
            'mood_level' => $mood ? $mood['mood_level'] : null,
            'mood_intensity' => $mood ? $mood['mood_intensity'] : null
        ];

        $chartData['progress'][$day] = [
            'expected_target' => $progress ? $progress['expected_target'] : null,
            'actual_target' => $progress ? $progress['actual_target'] : null,
            'is_achieved' => $progress ? $progress['is_achieved'] : null
        ];
    }

    return [
        'labels' => range(1, $daysInMonth),
        'mood' => $chartData['mood'],
        'progress' => $chartData['progress']
    ];
}

private function calculateAverageMood($mahasiswaId)
{
    $moodData = MoodTracker::where('mahasiswa_id', $mahasiswaId)->get();

    $moodLevels = [1, 2, 3, 4, 'unknown'];
    $moodCounts = array_fill_keys($moodLevels, 0);
    $totalMoods = $moodData->count();

    foreach ($moodData as $mood) {
        if (in_array($mood->mood_level, [1, 2, 3, 4])) {
            $moodCounts[$mood->mood_level]++;
        } else {
            $moodCounts['unknown']++;
        }
    }

    $averageMood = [];
    foreach ($moodLevels as $level) {
        $averageMood[$level] = $totalMoods ? ($moodCounts[$level] / $totalMoods) * 100 : 0;
    }

    return $averageMood;
}

}
