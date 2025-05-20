<?php

namespace App\Http\Controllers\Api\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MoodTracker;
use Illuminate\Support\Facades\DB;

class MoodController extends Controller
{
    public function storeMood(Request $request)
    {
        $moodMap = [
            'Marah' => 1,
            'Sedih' => 2,
            'Biasa saja' => 3,
            'Senang' => 4
        ];

        // Validasi Request
        $request->validate([
            'selectedEmotion' => 'required|string',
            'selectedIntensity' => 'required|string',
            'notes' => 'nullable|string|max:1000',
        ]);

        if (!isset($moodMap[$request->selectedEmotion])) {
            return response()->json([
                'message' => 'Emosi tidak valid'
            ], 400);
        }

        try {
            DB::transaction(function () use ($moodMap, $request) {
                MoodTracker::create([
                    'mahasiswa_id' => auth('sanctum')->id(),
                    'mood_level' => $moodMap[$request->selectedEmotion],
                    'mood_intensity' => $request->selectedIntensity,
                    'mood_note' => $request->notes,
                ]);
            });

            return response()->json([
                'message' => 'Mood berhasil disimpan!'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan mood',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
