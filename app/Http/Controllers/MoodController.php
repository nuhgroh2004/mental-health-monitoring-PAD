<?php

namespace App\Http\Controllers;

use App\Models\MoodTracker;
use Illuminate\Http\Request;

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
            // Simpan ke database
            MoodTracker::create([
                'mahasiswa_id' => auth()->id(),
                'mood_id' => $moodMap[$selectedEmotion],
                'mood_level' => $selectedIntensity,
                'mood_intensity' => $selectedIntensity,
                'mood_note' => $notes,
            ]);

            // Hapus data session setelah berhasil disimpan
            session()->forget(['selectedEmotion', 'selectedIntensity']);

            return redirect()->route('mahasiswa.home')
                           ->with('success', 'Mood kamu berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan saat menyimpan mood.')
                           ->withInput();
        }
    }
}
