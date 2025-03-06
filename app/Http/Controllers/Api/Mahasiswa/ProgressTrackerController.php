<?php

namespace App\Http\Controllers\Api\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProgressTracker;
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

            // Gunakan transaksi database untuk memastikan konsistensi
            $progress = DB::transaction(function () use ($request) {
                // Simpan progress
                $progress = ProgressTracker::create([
                    'mahasiswa_id' => auth('sanctum')->id(),
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
