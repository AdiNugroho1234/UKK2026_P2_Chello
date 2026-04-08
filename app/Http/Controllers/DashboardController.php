<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = date('Y-m-d');

        $totalUser = DB::table('users')->count();
        $totalKendaraan = DB::table('t_kendaraan')->count();

        $kendaraanPerHari = DB::table('t_transaksi')
            ->selectRaw('DATE(waktu_masuk) as tanggal, COUNT(*) as total')
            ->groupBy(DB::raw('DATE(waktu_masuk)'))
            ->orderBy('tanggal', 'ASC')
            ->get();

        $totalMasuk =
            DB::table('t_transaksi')->whereDate('waktu_masuk', $today)->count() +
            DB::table('t_riwayat')->whereDate('waktu_masuk', $today)->count();

        $totalKeluar = DB::table('t_riwayat')
            ->whereDate('waktu_keluar', $today)
            ->count();

        $pendapatanHari = DB::table('t_riwayat')
            ->whereDate('waktu_keluar', $today)
            ->sum('biaya_total');

        $pendapatanBulan = DB::table('t_riwayat')
            ->whereMonth('waktu_keluar', date('m'))
            ->whereYear('waktu_keluar', date('Y'))
            ->sum('biaya_total');

        $pendapatanTahun = DB::table('t_riwayat')
            ->whereYear('waktu_keluar', date('Y'))
            ->sum('biaya_total');

        $saldoCash = DB::table('t_riwayat')
            ->where('metode_pembayaran', 'cash')
            ->sum('biaya_total');

        $saldoMidtrans = DB::table('t_riwayat')
            ->where('metode_pembayaran', 'midtrans')
            ->sum('biaya_total');

        $totalSaldo = $saldoCash + $saldoMidtrans;

        return view('dashboard', compact(
            'user',
            'totalUser',
            'totalKendaraan',
            'kendaraanPerHari',
            'totalMasuk',
            'totalKeluar',
            'pendapatanHari',
            'pendapatanBulan',
            'pendapatanTahun',
            'saldoCash',
            'saldoMidtrans',
            'totalSaldo'
        ));
    }
}
