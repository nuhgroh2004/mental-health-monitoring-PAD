<?php

namespace App\Http\Controllers;

use App\Models\MoodTracker;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MoodController extends Controller
{
    public function showNotes()
    {
        return view('mahasiswa.notes');
    }

    public function storeMood(Request $request)
    {
        // Konversi emosi ke mood_id
        $moodMap = [
            'Marah' => 1,
            'Sedih' => 2,
            'Biasa saja' => 3,
            'Senang' => 4
        ];

        // Ambil data dari form
        $selectedEmotion = $request->input('selectedEmotion');
        $selectedIntensity = $request->input('selectedIntensity');
        $notes = $request->input('notes');

        // Validasi data
        $request->validate([
            'selectedEmotion' => 'required|string',
            'selectedIntensity' => 'required|string',
            'notes' => 'required|string|max:1000',
        ]);

        try {
            $mood = DB::transaction(function () use ($moodMap, $request) {
                // Simpan mood
                $mood = MoodTracker::create([
                    'mahasiswa_id' => auth()->id(),
                    'mood_id' => $moodMap[$request->selectedEmotion],
                    'mood_level' => $request->selectedIntensity,
                    'mood_intensity' => $request->selectedIntensity,
                    'mood_note' => $request->notes,
                ]);

                // Buat atau perbarui report
                $report = Report::updateOrCreate(
                    [
                        'mahasiswa_id' => auth()->id(),
                        'created_at' => Carbon::now()->toDateString()
                    ],
                    [
                        'mood_id' => $mood->getKey(),
                        'progress_id' => null
                    ]
                );

                return $mood;
            });

            session()->forget(['selectedEmotion', 'selectedIntensity']);

            return redirect()->route('mahasiswa.home')
                             ->with('success', 'Mood kamu berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan saat menyimpan mood: ' . $e->getMessage())
                             ->withInput();
        }
    }
}
