@extends('layouts.app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">
    <div class="row">

        <!-- FORM MASUK -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Transaksi Parkir Baru</h5>
                </div>

                <div class="card-body">

                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="/transaksi/masuk" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Kendaraan</label>
                            <select name="id_kendaraan" class="form-control" required>
                                <option value="">-- Pilih Kendaraan --</option>
                                @foreach($kendaraanTersedia as $k)
                                <option value="{{ $k->id }}">
                                    {{ $k->plat_kendaraan }} - {{ $k->jenis_kendaraan }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Area Parkir</label>
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

        <!-- TABEL -->
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    <h5>Data Transaksi</h5>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">

                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Plat</th>
                                    <th>Jenis</th>
                                    <th>Area</th>
                                    <th>Waktu</th>
                                    <th>Durasi</th>
                                    <th>Biaya</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($transaksi as $i => $t)
                                <tr data-status="{{ $t->status }}">

                                    <td>{{ $i+1 }}</td>
                                    <td><b>{{ $t->plat_kendaraan }}</b></td>
                                    <td>{{ $t->jenis_kendaraan }}</td>
                                    <td>{{ $t->nama_area }}</td>

                                    <!-- FIX ISO DATE -->
                                    <td data-waktu="{{ \Carbon\Carbon::parse($t->waktu_masuk)->toIso8601String() }}">
                                        {{ \Carbon\Carbon::parse($t->waktu_masuk)->format('d M Y H:i') }}
                                    </td>

                                    <td class="durasi" data-tarif="{{ $t->tarif_per_jam }}">
                                        @if($t->status == 'parkir')
                                        0 jam 0 menit
                                        @else
                                        {{ $t->durasi }}
                                        @endif
                                    </td>

                                    <td class="biaya">
                                        @if($t->status == 'parkir')
                                        Rp 0
                                        @else
                                        Rp {{ number_format($t->biaya_total,0,',','.') }}
                                        @endif
                                    </td>

                                    <td>
                                        @if($t->status == 'parkir')
                                        <span class="badge bg-warning">Parkir</span>
                                        @elseif($t->status == 'keluar')
                                        <span class="badge bg-info">Menunggu</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($t->status == 'parkir')
                                        <button class="btn btn-success btn-sm keluar-button"
                                            data-id="{{ $t->id }}">
                                            Keluar
                                        </button>
                                        @elseif($t->status == 'keluar')
                                        <button class="btn btn-warning btn-sm bayar-button"
                                            data-id="{{ $t->id }}"
                                            data-biaya="{{ $t->biaya_total }}">
                                            Bayar
                                        </button>
                                        @endif
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
</div>

<!-- MODAL -->
<div class="modal fade" id="modalBayar">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Pembayaran</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <h5 id="totalBayar"></h5>

                <input type="number" id="uangBayar" class="form-control mb-2" placeholder="Uang bayar">
                <input type="text" id="kembalian" class="form-control mb-3" readonly>

                <button class="btn btn-success w-100" id="btnCash">Bayar Cash</button>
            </div>

        </div>
    </div>
</div>

<script>
    let selectedId = null;
    let selectedBiaya = 0;

    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function updateDurasi() {
        document.querySelectorAll('table tbody tr').forEach(row => {

            if (row.dataset.status !== 'parkir') return;

            const tdDurasi = row.querySelector('.durasi');
            const tdBiaya = row.querySelector('.biaya');

            const tarif = parseInt(tdDurasi.dataset.tarif);
            const waktuMasuk = new Date(row.querySelector('[data-waktu]').dataset.waktu);

            if (isNaN(waktuMasuk)) return;

            const now = new Date();
            const diff = now - waktuMasuk;

            const menit = Math.floor(diff / 1000 / 60);
            const jam = Math.floor(menit / 60);
            const sisa = menit % 60;

            tdDurasi.innerText = jam + ' jam ' + sisa + ' menit';

            const biaya = Math.floor(menit * (tarif / 60));
            tdBiaya.innerText = 'Rp ' + biaya.toLocaleString('id-ID');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateDurasi();
        setInterval(updateDurasi, 60000);
    });

    document.addEventListener('click', function(e) {

        // ================= KELUAR =================
        const btnKeluar = e.target.closest('.keluar-button');

        if (btnKeluar) {

            const id = btnKeluar.dataset.id;

            if (!id) {
                alert('ID tidak ditemukan');
                return;
            }

            fetch(`/transaksi/keluar/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json'
                    }
                })
                .then(async res => {
                    const data = await res.json();
                    if (!res.ok) throw data;
                    return data;
                })
                .then(res => {
                    if (res.success) {
                        location.reload();
                    } else {
                        alert(res.error || 'Gagal keluar');
                    }
                })
                .catch(err => {
                    console.log(err);
                    alert(err.error || 'Error server saat keluar');
                });
        }

        // ================= BAYAR =================
        const btnBayar = e.target.closest('.bayar-button');

        if (btnBayar) {

            selectedId = btnBayar.dataset.id;
            selectedBiaya = parseInt(btnBayar.dataset.biaya || 0);

            document.getElementById('totalBayar').innerText =
                'Total: Rp ' + selectedBiaya.toLocaleString('id-ID');

            new bootstrap.Modal(document.getElementById('modalBayar')).show();
        }
    });

    document.getElementById('uangBayar').addEventListener('input', function() {
        const uang = parseInt(this.value) || 0;
        const kembali = uang - selectedBiaya;

        document.getElementById('kembalian').value =
            kembali >= 0 ? 'Rp ' + kembali.toLocaleString('id-ID') : 'Uang kurang';
    });

    document.getElementById('btnCash').onclick = function() {

        const uang = parseInt(document.getElementById('uangBayar').value);

        if (!uang || uang < selectedBiaya) {
            alert('Uang kurang!');
            return;
        }

        fetch(`/transaksi/bayar-cash/${selectedId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    uang_dibayar: uang
                })
            })
            .then(res => res.json())
            .then(() => {
                window.open(`/struk/${selectedId}`, '_blank');
                location.reload();
            });
    };
</script>

@endsection