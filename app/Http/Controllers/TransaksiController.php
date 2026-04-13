<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function dashboard()
    {
        $area = DB::table('t_area')->get();

        $kendaraanTersedia = DB::table('t_kendaraan')
            ->join('t_tarif', 't_kendaraan.id_tarif', '=', 't_tarif.id')
            ->whereNull('t_kendaraan.status')
            ->select(
                't_kendaraan.id',
                't_kendaraan.plat_kendaraan',
                't_tarif.jenis_kendaraan'
            )
            ->get();

        $transaksi = DB::table('t_transaksi')
            ->join('t_kendaraan', 't_transaksi.id_kendaraan', '=', 't_kendaraan.id')
            ->join('t_tarif', 't_transaksi.id_tarif', '=', 't_tarif.id')
            ->join('t_area', 't_transaksi.id_area', '=', 't_area.id')
            ->leftJoin('users', 't_transaksi.id_user', '=', 'users.id')
            ->whereIn('t_transaksi.status', ['parkir', 'keluar'])
            ->select(
                't_transaksi.*',
                't_kendaraan.plat_kendaraan',
                't_tarif.jenis_kendaraan',
                't_tarif.tarif_per_jam',
                't_area.nama_area',
                'users.shift as shift_user'
            )
            ->get();

        $terisiPerArea = DB::table('t_transaksi')
            ->select('id_area', DB::raw('COUNT(*) as terisi'))
            ->where('status', 'parkir')
            ->groupBy('id_area')
            ->pluck('terisi', 'id_area');

        return view('Transaksi.transaksi', compact(
            'kendaraanTersedia',
            'area',
            'transaksi',
            'terisiPerArea'
        ));
    }

    public function masukPage()
    {
        $area = DB::table('t_area')->get();

        $kendaraanTersedia = DB::table('t_kendaraan')
            ->join('t_tarif', 't_kendaraan.id_tarif', '=', 't_tarif.id')
            ->whereNull('t_kendaraan.status')
            ->select(
                't_kendaraan.id',
                't_kendaraan.plat_kendaraan',
                't_tarif.jenis_kendaraan'
            )
            ->get();

        $transaksi = DB::table('t_transaksi')
            ->join('t_kendaraan', 't_transaksi.id_kendaraan', '=', 't_kendaraan.id')
            ->join('t_tarif', 't_transaksi.id_tarif', '=', 't_tarif.id')
            ->join('t_area', 't_transaksi.id_area', '=', 't_area.id')
            ->whereIn('t_transaksi.status', ['parkir', 'keluar'])
            ->select(
                't_transaksi.*',
                't_kendaraan.plat_kendaraan',
                't_tarif.jenis_kendaraan',
                't_tarif.tarif_per_jam',
                't_area.nama_area'
            )
            ->get();

        $terisiPerArea = DB::table('t_transaksi')
            ->select('id_area', DB::raw('COUNT(*) as terisi'))
            ->where('status', 'parkir')
            ->groupBy('id_area')
            ->pluck('terisi', 'id_area');

        return view('Transaksi.transaksi', compact(
            'area',
            'kendaraanTersedia',
            'transaksi',
            'terisiPerArea'
        ));
    }

    public function masuk(Request $request)
    {
        $cek = DB::table('t_transaksi')
            ->where('id_kendaraan', $request->id_kendaraan)
            ->where('status', 'parkir')
            ->first();

        if ($cek) {
            return back()->with('error', 'Kendaraan masih parkir!');
        }

        $kendaraan = DB::table('t_kendaraan')
            ->where('id', $request->id_kendaraan)
            ->first();

        if (!$kendaraan) {
            return back()->with('error', 'Kendaraan tidak ditemukan');
        }

        DB::table('t_kendaraan')
            ->where('id', $kendaraan->id)
            ->update(['status' => 'parkir']);

        DB::table('t_transaksi')->insert([
            'id_kendaraan' => $kendaraan->id,
            'id_tarif'     => $kendaraan->id_tarif,
            'id_area'      => $request->id_area,
            'waktu_masuk'  => now(),
            'status'       => 'parkir',
            'id_user'      => Auth::id(),
        ]);

        return back()->with('success', 'Kendaraan berhasil masuk');
    }

    public function bayarCash(Request $request, $id)
    {
        try {

            $t = DB::table('t_transaksi')->where('id', $id)->first();
            if (!$t) return response()->json(['error' => 'Data tidak ditemukan'], 404);

            if ($t->status !== 'keluar') {
                return response()->json(['error' => 'Belum bisa bayar'], 400);
            }

            if ($request->uang_dibayar < $t->biaya_total) {
                return response()->json(['error' => 'Uang kurang'], 400);
            }

            $kembali = $request->uang_dibayar - $t->biaya_total;

            $kendaraan = DB::table('t_kendaraan')->where('id', $t->id_kendaraan)->first();
            $tarif = DB::table('t_tarif')->where('id', $t->id_tarif)->first();
            $area = DB::table('t_area')->where('id', $t->id_area)->first();

            DB::table('t_riwayat')->insert([
                'id_transaksi' => $t->id,

                // 🔥 WAJIB fallback biar tidak "-"
                'plat_kendaraan' => $kendaraan->plat_kendaraan ?? $t->plat_kendaraan,
                'jenis_kendaraan' => $tarif->jenis_kendaraan ?? '-',
                'nama_area' => $area->nama_area ?? '-',

                'waktu_masuk' => $t->waktu_masuk,
                'waktu_keluar' => $t->waktu_keluar,
                'durasi' => $t->durasi,

                'biaya_total' => $t->biaya_total,
                'uang_dibayar' => $request->uang_dibayar,
                'kembalian' => $kembali,

                'id_user' => $t->id_user,
                'status_pembayaran' => 'lunas',
                'metode_pembayaran' => 'cash',

                'created_at' => now()
            ]);

            DB::table('t_transaksi')->where('id', $id)->update([
                'status' => 'selesai'
            ]);

            DB::table('t_kendaraan')->where('id', $t->id_kendaraan)->update([
                'status' => 'selesai'
            ]);

            return response()->json([
                'success' => true,
                'kembalian' => $kembali
            ]);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function keluarPage()
    {
        $transaksi = DB::table('t_transaksi')
            ->join('t_kendaraan', 't_transaksi.id_kendaraan', '=', 't_kendaraan.id')
            ->join('t_tarif', 't_transaksi.id_tarif', '=', 't_tarif.id')
            ->join('t_area', 't_transaksi.id_area', '=', 't_area.id')
            ->where('t_transaksi.status', 'keluar')
            ->select(
                't_transaksi.*',
                't_kendaraan.plat_kendaraan',
                't_tarif.jenis_kendaraan',
                't_area.nama_area'
            )
            ->get();

        return view('Transaksi.keluar', compact('transaksi'));
    }


    public function keluar($id)
    {
        try {

            $t = DB::table('t_transaksi')->where('id', $id)->first();

            if (!$t) {
                return response()->json(['error' => 'Data tidak ditemukan'], 404);
            }

            if (!$t->waktu_masuk) {
                return response()->json(['error' => 'Waktu masuk kosong'], 400);
            }

            $tarif = DB::table('t_tarif')->where('id', $t->id_tarif)->first();

            if (!$tarif) {
                return response()->json(['error' => 'Tarif tidak ditemukan'], 400);
            }

            $menit = ceil((time() - strtotime($t->waktu_masuk)) / 60);
            $jam = floor($menit / 60);
            $sisa = $menit % 60;

            $biaya = round($menit * ($tarif->tarif_per_jam / 60));

            DB::table('t_transaksi')->where('id', $id)->update([
                'waktu_keluar' => now(),
                'durasi' => "$jam jam $sisa menit",
                'biaya_total' => $biaya,
                'status' => 'keluar'
            ]);

            DB::table('t_kendaraan')->where('id', $t->id_kendaraan)->update([
                'status' => 'selesai'
            ]);

            return response()->json([
                'success' => true,
                'biaya_total' => $biaya
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function struk($id)
    {
        $data = DB::table('t_riwayat')
            ->where('id_transaksi', $id)
            ->first();

        if (!$data) {
            return "Data tidak ditemukan";
        }

        return view('Transaksi.struk', [
            'data' => $data
        ]);
    }
}
