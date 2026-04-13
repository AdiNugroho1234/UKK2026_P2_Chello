<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    // ===============================
    // LIST AREA + TERISI
    // ===============================
    public function area()
    {
        $area = DB::table('t_area')
            ->orderBy('id', 'desc')
            ->get();

        $terisiPerArea = DB::table('t_transaksi')
            ->select('id_area', DB::raw('COUNT(*) as terisi'))
            ->where('status', 'parkir')
            ->groupBy('id_area')
            ->pluck('terisi', 'id_area');

        return view('Area.area', compact('area', 'terisiPerArea'));
    }

    // ===============================
    // FORM EDIT
    // ===============================
    public function show($id)
    {
        $area = DB::table('t_area')->where('id', $id)->first();

        if (!$area) {
            return redirect()->route('Area.area')
                ->with('error', 'Data area tidak ditemukan');
        }

        return view('Area.form', compact('area'));
    }

    // ===============================
    // FORM CREATE
    // ===============================
    public function create(Request $request)
    {
        $area = null;

        if ($request->filled('id')) {
            $area = DB::table('t_area')
                ->where('id', $request->id)
                ->first();
        }

        return view('Area.form', compact('area'));
    }

    // ===============================
    // DELETE
    // ===============================
    public function destroy($id)
    {
        $area = DB::table('t_area')->where('id', $id)->first();

        if (!$area) {
            return redirect()->route('Area.area')
                ->with('error', 'Data tidak ditemukan');
        }

        DB::table('t_area')->where('id', $id)->delete();

        return redirect()->route('Area.area')
            ->with('success', 'Data berhasil dihapus');
    }

    // ===============================
    // SIMPAN / UPDATE
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required',
            'kapasitas' => 'required|numeric'
        ]);

        $data = [
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas
        ];

        if ($request->filled('id')) {

            DB::table('t_area')
                ->where('id', $request->id)
                ->update($data);
        } else {

            DB::table('t_area')->insert($data);
        }

        return redirect()->route('Area.area')
            ->with('success', 'Data berhasil disimpan');
    }
}
