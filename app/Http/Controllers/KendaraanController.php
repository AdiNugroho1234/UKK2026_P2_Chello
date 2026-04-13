<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KendaraanController extends Controller
{
    // ===============================
    // LIST DATA
    // ===============================
    public function kendaraan()
    {
        $kendaraan = DB::table('t_kendaraan as k')
            ->join('t_tarif as t', 'k.id_tarif', '=', 't.id')
            ->select(
                'k.id',
                'k.plat_kendaraan',
                'k.warna',
                'k.id_tarif',
                't.jenis_kendaraan',
                't.tarif_per_jam'
            )
            ->whereNull('k.status')
            ->orderBy('k.id', 'desc')
            ->get();

        return view('Kendaraan.kendaraan', compact('kendaraan'));
    }

    // ===============================
    // FORM EDIT
    // ===============================
    public function show($id)
    {
        $kendaraan = DB::table('t_kendaraan')->where('id', $id)->first();

        if (!$kendaraan) {
            return redirect()->route('Kendaraan.kendaraan')
                ->with('error', 'Data kendaraan tidak ditemukan');
        }

        $tarif = DB::table('t_tarif')->orderBy('id')->get();

        return view('Kendaraan.form', compact('kendaraan', 'tarif'));
    }

    // ===============================
    // FORM CREATE
    // ===============================
    public function create(Request $request)
    {
        $kendaraan = null; // 🔥 biar konsisten object

        if ($request->filled('id')) {
            $kendaraan = DB::table('t_kendaraan')
                ->where('id', $request->id)
                ->first();
        }

        $tarif = DB::table('t_tarif')->orderBy('id')->get();

        return view('Kendaraan.form', compact('kendaraan', 'tarif'));
    }

    // ===============================
    // DELETE
    // ===============================
    public function destroy($id)
    {
        $kendaraan = DB::table('t_kendaraan')->where('id', $id)->first();

        if (!$kendaraan) {
            return redirect()->route('Kendaraan.kendaraan')
                ->with('error', 'Data tidak ditemukan');
        }

        DB::table('t_kendaraan')->where('id', $id)->delete();

        $this->logAktivitas(auth()->id(), "Hapus: {$kendaraan->plat_kendaraan}");

        return redirect()->route('Kendaraan.kendaraan')
            ->with('success', 'Data berhasil dihapus');
    }

    // ===============================
    // SIMPAN / UPDATE
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'plat_kendaraan' => 'required',
            'id_tarif' => 'required',
            'warna' => 'required'
        ]);

        $data = [
            'plat_kendaraan' => $request->plat_kendaraan,
            'id_tarif' => $request->id_tarif,
            'warna' => $request->warna
        ];

        $userId = auth()->id();

        // 🔥 UPDATE
        if ($request->filled('id')) {

            DB::table('t_kendaraan')
                ->where('id', $request->id)
                ->update($data);

            $this->logAktivitas($userId, "Edit: {$request->plat_kendaraan}");
        } else {

            // 🔥 INSERT
            DB::table('t_kendaraan')->insert($data);

            $this->logAktivitas($userId, "Tambah: {$request->plat_kendaraan}");
        }

        return redirect()->route('Kendaraan.kendaraan')
            ->with('success', 'Data berhasil disimpan');
    }

    // ===============================
    // LOG
    // ===============================
    private function logAktivitas($id_user, $aktivitas)
    {
        DB::table('t_log_aktivitas')->insert([
            'id_user' => $id_user,
            'aktivitas' => $aktivitas,
            'waktu_aktivitas' => now()
        ]);
    }
}
