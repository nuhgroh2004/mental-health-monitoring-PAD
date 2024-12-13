<?php

namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;

use App\Models\MoodTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            DB::transaction(function () use ($moodMap, $request) {
                // Simpan mood
                MoodTracker::create([
                    'mahasiswa_id' => auth()->id(),
                    'mood_level' => $moodMap[$request->selectedEmotion],
                    'mood_intensity' => $request->selectedIntensity,
                    'mood_note' => $request->notes,
                ]);
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
