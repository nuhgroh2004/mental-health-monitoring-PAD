<?php

namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;

use App\Models\ProgressTracker;
use App\Models\MoodTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProgressTrackerController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'expected_target' => 'required|integer',
                'actual_target' => 'required|integer',
                'is_achieved' => 'required|boolean'
            ]);

            // Cari mood terakhir untuk mahasiswa yang sedang login
            $lastMood = MoodTracker::where('mahasiswa_id', auth()->id())
                                    ->orderBy('created_at', 'desc')
                                    ->first();

            // Gunakan transaksi database untuk memastikan konsistensi
            $progress = DB::transaction(function () use ($request, $lastMood) {
                // Simpan progress
                $progress = ProgressTracker::create([
                    'mahasiswa_id' => auth()->id(),
                    'expected_target' => $request->expected_target,
                    'actual_target' => $request->actual_target,
                    'is_achieved' => $request->is_achieved,
                    'tracking_date' => Carbon::now()->toDateString()
                ]);

                return $progress;
            });

            return response()->json([
                'success' => true,
                'message' => 'Progress berhasil disimpan',
                'data' => $progress
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan progress: ' . $e->getMessage()
            ], 500);
        }
    }
}
