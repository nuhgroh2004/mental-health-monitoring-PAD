<?php

namespace App\Http\Controllers;

use App\Models\ProgressTracker;
use App\Models\MoodTracker;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'expected_target' => 'required|integer',
                'actual_target' => 'required|integer',
                'is_achieved' => 'required|boolean',
                'selectedEmotion' => 'required|string',
                'selectedIntensity' => 'required|string',
                'notes' => 'required|string|max:1000',
            ]);

            // Konversi emosi ke mood_id
            $moodMap = [
                'Marah' => 1,
                'Sedih' => 2,
                'Biasa saja' => 3,
                'Senang' => 4
            ];

            // Gunakan transaksi database untuk memastikan konsistensi
            $report = DB::transaction(function () use ($request, $moodMap) {
                // Simpan progress
                $progress = ProgressTracker::create([
                    'mahasiswa_id' => auth()->id(),
                    'expected_target' => $request->expected_target,
                    'actual_target' => $request->actual_target,
                    'is_achieved' => $request->is_achieved,
                    'tracking_date' => Carbon::now()->toDateString()
                ]);

                // Simpan mood
                $mood = MoodTracker::create([
                    'mahasiswa_id' => auth()->id(),
                    'mood_id' => $moodMap[$request->selectedEmotion],
                    'mood_level' => $request->selectedIntensity,
                    'mood_intensity' => $request->selectedIntensity,
                    'mood_note' => $request->notes,
                ]);

                // Buat entri report
                $report = Report::create([
                    'progress_id' => $progress->getKey(),
                    'mood_id' => $mood->getKey(),
                    'mahasiswa_id' => auth()->id()
                ]);

                return $report;
            });

            // Hapus data session setelah berhasil disimpan
            session()->forget(['selectedEmotion', 'selectedIntensity']);

            return redirect()->route('mahasiswa.home')
                           ->with('success', 'Laporan berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan saat menyimpan laporan: ' . $e->getMessage())
                           ->withInput();
        }
    }

    public function showReport(Request $request)
    {
        try {
            // Ambil bulan dan tahun saat ini
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

            // Ambil data report untuk bulan dan tahun ini
            $reports = Report::where('mahasiswa_id', auth()->user()->user_id)
                            ->whereMonth('created_at', $currentMonth)  // Filter berdasarkan bulan
                            ->whereYear('created_at', $currentYear)    // Filter berdasarkan tahun
                            ->with(['progress', 'mood'])                // Mengambil relasi progress dan mood
                            ->get();

            // dd($reports);

            // Kirim data ke view
            return view('mahasiswa.report', compact('reports'));
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan saat mengambil laporan: ' . $e->getMessage());
        }
    }


}
