<?php

namespace App\Http\Controllers\Api\Mahasiswa;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\MoodTracker;
use App\Models\User;

class MoodCalendarController extends Controller
{
    public function calendar(Request $request)
    {
        $month = $request->query('month', now()->month);
        $year = $request->query('year', now()->year);

        // Batasi agar tidak bisa melebihi bulan saat ini
        $currentMonth = now()->month;
        $currentYear = now()->year;

        if ($year > $currentYear || ($year == $currentYear && $month > $currentMonth)) {
            $month = $currentMonth;
            $year = $currentYear;
        }

        // Ambil mood berdasarkan bulan dan tahun yang dipilih, dan mahasiswa yang sedang login
        $moods = MoodTracker::whereMonth('created_at', $month)
                            ->whereYear('created_at', $year)
                            ->where('mahasiswa_id', auth()->user()->user_id)
                            ->get();

        // dd($moods->toArray());

        // Siapkan array untuk menempatkan mood berdasarkan tanggal
        $moodByDay = [];
        foreach ($moods as $mood) {
            $day = Carbon::parse($mood->created_at)->day;
            $moodByDay[$day] = $mood;
        }

        return response()->json([
            'success' => true,
            'month' => $month,
            'year' => $year,
            'data' => $moodByDay
        ]);
    }

    public function showEditMoodsDanNotes(Request $request)
    {
        $day = $request->input('day');
        $month = $request->input('month');
        $year = $request->input('year');
        $user_id = auth()->user()->user_id; // Dapatkan ID pengguna yang sedang login

        // Ambil data mood sesuai dengan tanggal dan user_id
        $mood = MoodTracker::where('mahasiswa_id', $user_id)
                    ->whereDay('created_at', $day)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->first();

        return response()->json([
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'mood' => $mood
        ]);
    }

    public function updateMoodNote(Request $request, $id)
    {
        $request->validate([
            'mood_level' => 'required|integer',
            'mood_note' => 'nullable|string|max:300',
            'mood_intensity' => 'required|string',
        ]);

        // Cari row berdasarkan id atau mahasiswa_id jika tidak menggunakan ID unik
        $mood = MoodTracker::where('mood_id', $id)
                   ->where('mahasiswa_id', auth()->user()->user_id)
                   ->first();

        if (!$mood) {
            return response()->json(['error' => 'Data tidak ditemukan atau tidak diizinkan.'], 403);
        }

        $mood->mood_level = $request->mood_level;
        $mood->mood_note = $request->mood_note;
        $mood->mood_intensity = $request->mood_intensity;
        $mood->save();

        return response()->json([
            'success' => true,
            'message' => 'Mood dan catatan berhasil diperbarui.',
            'data' => $mood
        ]);
    }
}
