@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h4>{{ $tarif ? 'Edit Tarif' : 'Tambah Tarif' }}</h4>

        <form action="{{ route('Tarif.save') }}" method="POST">
            @csrf

            <!-- ID -->
            <input type="hidden" name="id" value="{{ $tarif->id ?? '' }}">

            <!-- JENIS -->
            <div class="mb-3">
                <label>Jenis Kendaraan</label>
                <input type="text" name="jenis_kendaraan" class="form-control"
                    value="{{ $tarif->jenis_kendaraan ?? '' }}" required>
            </div>

            <!-- TARIF -->
            <div class="mb-3">
                <label>Tarif / Jam</label>
                <input type="number" name="tarif_per_jam" class="form-control"
                    value="{{ $tarif->tarif_per_jam ?? '' }}" required>
            </div>

            <!-- BUTTON -->
            <button type="submit" class="btn btn-primary">
                {{ $tarif ? 'Update' : 'Simpan' }}
            </button>
        </form>

    </div>
</div>
@endsection