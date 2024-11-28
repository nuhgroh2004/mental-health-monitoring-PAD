<?php

namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;

use App\Models\ProgressTracker;
use App\Models\MoodTracker;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        $months = [
            ['value' => 1, 'name' => 'Januari'],
            ['value' => 2, 'name' => 'Februari'],
            ['value' => 3, 'name' => 'Maret'],
            ['value' => 4, 'name' => 'April'],
            ['value' => 5, 'name' => 'Mei'],
            ['value' => 6, 'name' => 'Juni'],
            ['value' => 7, 'name' => 'Juli'],
            ['value' => 8, 'name' => 'Agustus'],
            ['value' => 9, 'name' => 'September'],
            ['value' => 10, 'name' => 'Oktober'],
            ['value' => 11, 'name' => 'November'],
            ['value' => 12, 'name' => 'Desember'],
        ];

        // Ambil data mood untuk bulan yang dipilih
        $moodData = MoodTracker::where('mahasiswa_id', auth()->user()->user_id)
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

        // Ambil data progress untuk bulan yang dipilih
        $progressData = ProgressTracker::where('mahasiswa_id', auth()->user()->user_id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get()
            ->map(function ($progress) {
                return [
                    'day' => Carbon::parse($progress->created_at)->day,
                    'expected_target' => $progress->expected_target / 3600, // Konversi detik ke jam
                    'actual_target' => $progress->actual_target / 3600, // Konversi detik ke jam
                    'is_achieved' => $progress->is_achieved
                ];
            })
            ->keyBy('day');

        // dd($moodData,$progressData);

        // Siapkan data untuk chart
        $chartData = $this->prepareChartData($moodData, $progressData, $month, $year);

        return view('mahasiswa.report', compact('months', 'month', 'year', 'chartData'));
    }

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
}
