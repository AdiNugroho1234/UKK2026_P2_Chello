@extends('layouts.app')
@section('content')

<div class="row">

    <!-- FORM MASUK -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Transaksi Masuk</h5>
            </div>

            <div class="card-body">
                <form action="{{ url('/Transaksi/masuk') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Kendaraan</label>
                        <select name="id_kendaraan" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($kendaraanTersedia as $k)
                            <option value="{{ $k->id }}">
                                {{ $k->plat_kendaraan }} - {{ $k->jenis_kendaraan }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Area</label>
                        <select name="id_area" class="form-control" required>
                            <option value="">-- Pilih Area --</option>
                            @foreach($area as $a)
                            <option value="{{ $a->id }}"
                                {{ ($terisiPerArea[$a->id] ?? 0) >= $a->kapasitas ? 'disabled' : '' }}>
                                {{ $a->nama_area }}
                                ({{ $terisiPerArea[$a->id] ?? 0 }}/{{ $a->kapasitas }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary w-100">Masuk</button>
                </form>
            </div>
        </div>
    </div>

    <!-- TABEL PARKIR -->
    <div class="col-md-8">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title mb-0">Kendaraan Parkir</h4>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-nowrap align-middle">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Plat</th>
                                <th>Jenis</th>
                                <th>Area</th>
                                <th>Waktu Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($transaksi as $t)
                            <tr data-waktu="{{ $t->waktu_masuk }}">

                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $t->plat_kendaraan }}</strong></td>
                                <td>{{ $t->jenis_kendaraan }}</td>
                                <td>{{ $t->nama_area }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($t->waktu_masuk)->format('d M Y H:i') }}
                                </td>

                                <td>
                                    <button class="btn btn-success btn-sm keluar"
                                        data-id="{{ $t->id }}">
                                        Keluar
                                    </button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
// realtime durasi
setInterval(() => {
    document.querySelectorAll('tbody tr').forEach(row => {

        const masuk = new Date(row.dataset.waktu);
        const tarif = row.querySelector('.durasi').dataset.tarif;

        const now = new Date();
        const menit = Math.floor((now - masuk) / 60000);

        const jam = Math.floor(menit / 60);
        const sisa = menit % 60;

        row.querySelector('.durasi').innerText = jam + ' jam ' + sisa + ' menit';

        const biaya = Math.floor(menit * (tarif / 60));
        row.querySelector('.biaya').innerText = 'Rp ' + biaya.toLocaleString('id-ID');
    });
}, 60000);

// keluar
document.addEventListener('click', e => {
    if (e.target.classList.contains('keluar')) {

        fetch(`/Transaksi/keluar/${e.target.dataset.id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(() => location.reload());
    }
});
</script>

@endsection