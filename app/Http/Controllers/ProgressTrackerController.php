<?php

namespace App\Http\Controllers;

use App\Models\ProgressTracker;
use Illuminate\Http\Request;
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

            $progress = ProgressTracker::create([
                'mahasiswa_id' => auth()->id(),
                'expected_target' => $request->expected_target,
                'actual_target' => $request->actual_target,
                'is_achieved' => $request->is_achieved,
                'tracking_date' => Carbon::now()->toDateString()
            ]);

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
