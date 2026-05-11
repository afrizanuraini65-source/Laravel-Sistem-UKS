<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Medicine;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $medicinesOutOfStock = Medicine::where('stok', '<=', 5)->count();
        $visitsThisMonth = Treatment::whereMonth('tanggal_kunjungan', Carbon::now()->month)
                                    ->whereYear('tanggal_kunjungan', Carbon::now()->year)
                                    ->count();

        // 5 kunjungan terbaru untuk tabel dashboard
        $latestTreatments = Treatment::with('student.kelas')
            ->latest('tanggal_kunjungan')
            ->limit(5)
            ->get();

        // Monthly data for chart
        $monthlyVisits = Treatment::select(
            DB::raw('count(id) as total'),
            DB::raw('MONTH(tanggal_kunjungan) as month')
        )
        ->whereYear('tanggal_kunjungan', Carbon::now()->year)
        ->groupBy('month')
        ->get()
        ->pluck('total', 'month')
        ->toArray();

        // Fill missing months with 0
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $monthlyVisits[$i] ?? 0;
        }

        return view('dashboard', compact('totalStudents', 'medicinesOutOfStock', 'visitsThisMonth', 'chartData', 'latestTreatments'));
    }
}
