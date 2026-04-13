@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title mb-0">Pembayaran Parkir</h4>
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
                                <th>Durasi</th>
                                <th>Biaya</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($transaksi as $t)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $t->plat_kendaraan }}</strong></td>
                                <td>{{ $t->jenis_kendaraan }}</td>
                                <td>{{ $t->nama_area }}</td>
                                <td>{{ $t->durasi }}</td>
                                <td>Rp {{ number_format($t->biaya_total,0,',','.') }}</td>

                                <td>
                                    <button class="btn btn-warning btn-sm bayar"
                                        data-id="{{ $t->id }}"
                                        data-biaya="{{ $t->biaya_total }}">
                                        Bayar
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

<!-- MODAL -->
<div class="modal fade" id="modalBayar">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Pembayaran</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <h5 id="total"></h5>

                <input type="number" id="uang" class="form-control mb-2" placeholder="Uang bayar">
                <input type="text" id="kembali" class="form-control mb-3" readonly>

                <button class="btn btn-success w-100" id="btnBayar">Bayar</button>
            </div>

        </div>
    </div>
</div>

<script>
let id = null;
let biaya = 0;

// buka modal
document.addEventListener('click', e => {
    if (e.target.classList.contains('bayar')) {
        id = e.target.dataset.id;
        biaya = parseInt(e.target.dataset.biaya);

        document.getElementById('total').innerText =
            'Total: Rp ' + biaya.toLocaleString('id-ID');

        new bootstrap.Modal(document.getElementById('modalBayar')).show();
    }
});

// hitung kembalian
document.getElementById('uang').addEventListener('input', function() {
    const val = parseInt(this.value) || 0;
    const kembali = val - biaya;

    document.getElementById('kembali').value =
        kembali >= 0 ? 'Rp ' + kembali.toLocaleString('id-ID') : 'Uang kurang';
});

// bayar
document.getElementById('btnBayar').onclick = function() {
    const uang = parseInt(document.getElementById('uang').value);

    if (uang < biaya) {
        alert('Uang kurang!');
        return;
    }

    fetch(`/Transaksi/bayar-cash/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            uang_dibayar: uang
        })
    }).then(() => {
        window.open(`/struk/${id}`, '_blank');
        location.reload();
    });
};
</script>

@endsection