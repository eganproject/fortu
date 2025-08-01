<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Data Kunjungan Hari Ini
        $totalVisitsToday = Visitor::where('visit_date', $today)->sum('visits');
        $uniqueVisitsToday = Visitor::where('visit_date', $today)->count();

        // Data Kunjungan Kemarin
        $totalVisitsYesterday = Visitor::where('visit_date', $yesterday)->sum('visits');
        $uniqueVisitsYesterday = Visitor::where('visit_date', $yesterday)->count();

        // Hitung Persentase Perubahan
        $percentageChangeUnique = $this->calculatePercentageChange($uniqueVisitsToday, $uniqueVisitsYesterday);
        $percentageChangeTotal = $this->calculatePercentageChange($totalVisitsToday, $totalVisitsYesterday);

        // Data Semua Waktu
        $totalVisitsAllTime = Visitor::sum('visits');
        $totalUniqueVisitorsAllTime = Visitor::distinct()->count('ip_address');

        // Kirim data ke view
        return view('admin.dashboard.index', [
            'totalVisitsToday' => $totalVisitsToday,
            'uniqueVisitsToday' => $uniqueVisitsToday,
            'totalVisitsAllTime' => $totalVisitsAllTime,
            'totalUniqueVisitorsAllTime' => $totalUniqueVisitorsAllTime,

            'percentageChangeUnique' => $percentageChangeUnique,
            'percentageChangeTotal' => $percentageChangeTotal,
        ]);
    }

    private function calculatePercentageChange(int $current, int $previous): float
    {
        if ($previous == 0) {
            // Jika angka kemarin 0, dan hari ini > 0, anggap kenaikan 100%
            // Jika keduanya 0, tidak ada perubahan.
            return $current > 0 ? 100.0 : 0.0;
        }

        return (($current - $previous) / $previous) * 100;
    }
}
