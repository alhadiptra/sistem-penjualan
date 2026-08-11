<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf; // ✅ TAMBAHKAN INI
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function daily()
    {
        $orders = Order::with('user')
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->get();

        $totalRevenue = $orders->where('status', 'selesai')->sum('total_harga');

        return view('owner.reports.daily', compact('orders', 'totalRevenue'));
    }

    public function monthly()
    {
        $orders = Order::with('user')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalRevenue = $orders->where('status', 'selesai')->sum('total_harga');

        return view('owner.reports.monthly', compact('orders', 'totalRevenue'));
    }

    // ✅ TAMBAHKAN METHOD INI UNTUK EXPORT PDF HARIAN
    public function exportDailyPDF(Request $request)
    {
        $tanggal = $request->tanggal ?? today()->format('Y-m-d');

        $orders = Order::with('user')
            ->whereDate('created_at', $tanggal)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalRevenue = $orders->where('status', 'selesai')->sum('total_harga');
        $totalAll = $orders->sum('total_harga');

        $pdf = Pdf::loadView('owner.reports.daily-pdf', compact('orders', 'totalRevenue', 'totalAll', 'tanggal'));

        return $pdf->download('laporan-harian-' . $tanggal . '.pdf');
    }

    // ✅ TAMBAHKAN METHOD INI UNTUK EXPORT PDF BULANAN
    public function exportMonthlyPDF(Request $request)
    {
        $bulan = $request->bulan ?? now()->format('Y-m');
        $tahun = date('Y', strtotime($bulan));
        $bulanNum = date('m', strtotime($bulan));

        $orders = Order::with('user')
            ->whereMonth('created_at', $bulanNum)
            ->whereYear('created_at', $tahun)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalRevenue = $orders->where('status', 'selesai')->sum('total_harga');
        $totalAll = $orders->sum('total_harga');

        $pdf = Pdf::loadView('owner.reports.monthly-pdf', compact('orders', 'totalRevenue', 'totalAll', 'bulan'));

        return $pdf->download('laporan-bulanan-' . $bulan . '.pdf');
    }
}
