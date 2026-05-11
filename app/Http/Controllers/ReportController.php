<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        // Weekly data for the table in selected month
        $recapData = Treatment::with('student.kelas', 'medicines')
            ->whereMonth('tanggal_kunjungan', $month)
            ->whereYear('tanggal_kunjungan', $year)
            ->latest('tanggal_kunjungan')
            ->get();

        // Monthly data for chart (Whole Year)
        $monthlyVisits = Treatment::select(
            DB::raw('count(id) as total'),
            DB::raw('MONTH(tanggal_kunjungan) as month_num')
        )
        ->whereYear('tanggal_kunjungan', $year)
        ->groupBy('month_num')
        ->pluck('total', 'month_num')
        ->toArray();

        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $monthlyVisits[$i] ?? 0;
        }

        return view('reports.index', compact('recapData', 'chartData', 'month', 'year'));
    }
}
