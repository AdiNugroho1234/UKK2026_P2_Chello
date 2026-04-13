@extends('layouts.app')

@section('content')

<style>
    .card-modern {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        padding: 25px;
    }

    .btn-purple {
        background: #6f42c1;
        color: white;
        border: none;
        padding: 7px 16px;
        border-radius: 6px;
    }

    .btn-purple:hover {
        background: #5a35a5;
        color: white;
    }
</style>

<div class="container-fluid">

    <div class="card-modern">

        <h4 style="color:#6f42c1;font-weight:600" class="mb-4">
            {{ $kendaraan ? 'Edit Kendaraan' : 'Tambah Kendaraan' }}
        </h4>

        <form action="{{ route('Kendaraan.store') }}" method="POST">
            @csrf

            <!-- ID -->
            <input type="hidden" name="id" value="{{ $kendaraan->id ?? '' }}">

            <!-- PLAT -->
            <div class="mb-3">
                <label class="form-label">Plat Nomor</label>
                <input type="text"
                    name="plat_kendaraan"
                    class="form-control"
                    value="{{ $kendaraan->plat_kendaraan ?? '' }}"
                    required>
            </div>

            <!-- JENIS -->
            <div class="mb-3">
                <label class="form-label">Jenis Kendaraan</label>

                <select name="id_tarif" class="form-control" required>
                    <option value="">-- Pilih Jenis Kendaraan --</option>

                    @foreach($tarif as $item)
                    <option value="{{ $item->id }}"
                        {{ ($kendaraan->id_tarif ?? '') == $item->id ? 'selected' : '' }}>
                        {{ $item->jenis_kendaraan }} - Rp {{ number_format($item->tarif_per_jam) }}/jam
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- WARNA -->
            <div class="mb-3">
                <label class="form-label">Warna</label>
                <input type="text"
                    name="warna"
                    class="form-control"
                    value="{{ $kendaraan->warna ?? '' }}"
                    required>
            </div>

            <!-- BUTTON -->
            <div class="mt-4">
                <button class="btn-purple">
                    {{ $kendaraan ? 'Update' : 'Simpan' }}
                </button>

                <a href="{{ route('Kendaraan.kendaraan') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection