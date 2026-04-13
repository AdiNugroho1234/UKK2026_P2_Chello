@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h4>{{ $area ? 'Edit Area' : 'Tambah Area' }}</h4>

        <form action="{{ route('Area.store') }}" method="POST">
            @csrf

            <!-- ID -->
            <input type="hidden" name="id" value="{{ $area->id ?? '' }}">

            <!-- NAMA AREA -->
            <div class="mb-3">
                <label>Nama Area</label>
                <input type="text" name="nama_area" class="form-control"
                    value="{{ $area->nama_area ?? '' }}" required>
            </div>

            <!-- KAPASITAS -->
            <div class="mb-3">
                <label>Kapasitas</label>
                <input type="number" name="kapasitas" class="form-control"
                    value="{{ $area->kapasitas ?? '' }}" required>
            </div>

            <!-- BUTTON -->
            <button type="submit" class="btn btn-primary">
                {{ $area ? 'Update' : 'Simpan' }}
            </button>
        </form>

    </div>
</div>
@endsection