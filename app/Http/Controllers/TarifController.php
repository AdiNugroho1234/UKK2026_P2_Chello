<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarifController extends Controller
{
    // ===============================
    // LIST TARIF
    // ===============================
    public function index()
    {
        $tarif = DB::table('t_tarif')->orderBy('id', 'desc')->get();
        return view('Tarif.tarif', compact('tarif'));
    }

    // ===============================
    // FORM CREATE / EDIT
    // ===============================
    public function form($id = null)
    {
        $tarif = null;

        if ($id) {
            $tarif = DB::table('t_tarif')->where('id', $id)->first();

            if (!$tarif) {
                return redirect()->route('Tarif.tarif')
                    ->with('error', 'Data tidak ditemukan');
            }
        }

        return view('Tarif.create', compact('tarif'));
    }

    // ===============================
    // SIMPAN / UPDATE
    // ===============================
    public function save(Request $request)
    {
        $request->validate([
            'jenis_kendaraan' => 'required',
            'tarif_per_jam' => 'required|numeric'
        ]);

        $data = [
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'tarif_per_jam' => $request->tarif_per_jam
        ];

        // 🔥 CEK UPDATE ATAU INSERT
        if ($request->filled('id')) {

            DB::table('t_tarif')
                ->where('id', $request->id)
                ->update($data);
        } else {

            DB::table('t_tarif')->insert($data);
        }

        return redirect()->route('Tarif.tarif')
            ->with('success', 'Data berhasil disimpan');
    }

    // ===============================
    // DELETE
    // ===============================
    public function delete($id)
    {
        $cek = DB::table('t_tarif')->where('id', $id)->first();

        if (!$cek) {
            return redirect()->route('Tarif.tarif')
                ->with('error', 'Data tidak ditemukan');
        }

        DB::table('t_tarif')->where('id', $id)->delete();

        return redirect()->route('Tarif.tarif')
            ->with('success', 'Data berhasil dihapus');
    }
}
