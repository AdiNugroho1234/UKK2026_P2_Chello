@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card-modern">
        <h4 class="mb-4" style="color:#6f42c1;font-weight:600">Form Masuk Kendaraan</h4>
        <form action="{{ route('Transaksi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Kendaraan</label>
                <select name="id_kendaraan" class="form-control" required>
                    <option value="">-- Pilih Kendaraan --</option>
                    @foreach($kendaraan as $k)
                        <option value="{{ $k->id }}">{{ $k->plat_kendaraan }} - {{ $k->jenis_kendaraan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Area Parkir</label>
                <select name="id_area" class="form-control" required>
                    <option value="1">Area 1</option>
                    <option value="2">Area 2</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Masuk Parkir</button>
        </form>
    </div>
</div>
@endsection