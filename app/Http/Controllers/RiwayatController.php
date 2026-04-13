<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('t_riwayat');

        if ($request->dari && $request->sampai) {
            $query->whereBetween('waktu_masuk', [
                $request->dari . ' 00:00:00',
                $request->sampai . ' 23:59:59'
            ]);
        }

        $riwayat = $query->get();

        return view('Riwayat.riwayat', compact('riwayat'));
    }
}
