<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function aktivitas()
    {
        $log = DB::table('t_log_aktivitas')
            ->leftJoin('users', 't_log_aktivitas.id_user', '=', 'users.id')
            ->select('t_log_aktivitas.*', 'users.name')
            ->orderBy('waktu_aktivitas', 'desc')
            ->get();

        return view('Aktivitas.aktivitas', compact('log'));
    }
}
