@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Riwayat Parkir</h4>

            <button id="print-struk" class="btn btn-primary btn-sm">
                <i class="bi bi-printer"></i> Print
            </button>
        </div>
    </div>

    <div class="row">

        <!-- FILTER (KIRI) -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <strong>Filter</strong>
                </div>

                <div class="card-body">
                    <form method="GET">

                        <div class="mb-3">
                            <label>Dari</label>
                            <input type="date" name="dari" class="form-control"
                                value="{{ request('dari') }}">
                        </div>

                        <div class="mb-3">
                            <label>Sampai</label>
                            <input type="date" name="sampai" class="form-control"
                                value="{{ request('sampai') }}">
                        </div>

                        <button class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-search"></i> Cari
                        </button>

                    </form>
                </div>
            </div>
        </div>

        <!-- TABLE (KANAN) -->
        <div class="col-md-9">
            <div class="card">

                <div class="card-header d-flex justify-content-between">
                    <span>Data Riwayat</span>

                    @if(request('dari') && request('sampai'))
                    <small class="text-muted">
                        {{ request('dari') }} - {{ request('sampai') }}
                    </small>
                    @endif
                </div>

                <div class="card-body">

                    <div class="table-responsive" id="area-print">
                        <table class="table table-striped table-hover align-middle">

                            <thead class="table-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Plat</th>
                                    <th>Jenis</th>
                                    <th>Area</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                    <th>Durasi</th>
                                    <th>Biaya</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                @forelse ($riwayat as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td><strong>{{ $item->plat_kendaraan }}</strong></td>

                                    <td>
                                        <span class="badge bg-info">
                                            {{ $item->jenis_kendaraan }}
                                        </span>
                                    </td>

                                    <td>{{ $item->nama_area }}</td>

                                    <td>{{ \Carbon\Carbon::parse($item->waktu_masuk)->format('d/m/Y H:i') }}</td>

                                    <td>{{ \Carbon\Carbon::parse($item->waktu_keluar)->format('d/m/Y H:i') }}</td>

                                    <td>{{ $item->durasi }}</td>

                                    <td>
                                        <span class="badge bg-success">
                                            Rp {{ number_format($item->biaya_total,0,',','.') }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($item->status_pembayaran) }}
                                        </span>
                                    </td>

                                </tr>

                                @empty
                                <tr>
                                    <td colspan="10" class="text-muted text-center">
                                        Tidak ada data
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

<!-- JS TETAP -->
<script>
    document.getElementById('print-struk').addEventListener('click', function() {
        const printArea = document.getElementById('area-print').innerHTML;

        const win = window.open('', '', 'width=900,height=700');

        win.document.write(`
            <html>
                <head>
                    <title>Struk Riwayat Parkir</title>
                    <style>
                        body { font-family: Arial; padding: 20px; }
                        table { width: 100%; border-collapse: collapse; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
                        th { background: #6f42c1; color: white; }
                    </style>
                </head>
                <body>
                    <h3 style="text-align:center;">Riwayat Parkir</h3>
                    ${printArea}
                </body>
            </html>
        `);

        win.document.close();
        win.print();
    });
</script>

@endsection