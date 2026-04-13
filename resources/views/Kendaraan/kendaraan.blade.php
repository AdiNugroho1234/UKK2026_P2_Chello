@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">

            <!-- HEADER -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Data Kendaraan</h4>

                <div class="d-flex gap-2">
                    <button onclick="printTable('kendaraanTable')" class="btn btn-success btn-sm">
                        <i class="mdi mdi-printer"></i> Print
                    </button>

                    <a href="{{ route('Kendaraan.form') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-plus"></i> Tambah
                    </a>
                </div>
            </div>

            <!-- BODY -->
            <div class="card-body">

                <div class="table-responsive" id="kendaraanTable">
                    <table class="table table-editable table-nowrap align-middle table-edits">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Plat Nomor</th>
                                <th>Jenis</th>
                                <th>Tarif</th>
                                <th>Warna</th>
                                <th class="no-print">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kendaraan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td><strong>{{ $item->plat_kendaraan }}</strong></td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ $item->jenis_kendaraan }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-success">
                                        Rp {{ number_format($item->tarif_per_jam,0,',','.') }}
                                    </span>
                                </td>

                                <td>{{ $item->warna }}</td>

                                <td class="no-print">
                                    <a href="{{ route('Kendaraan.show',$item->id) }}"
                                        class="btn btn-outline-warning btn-sm">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    <form action="{{ route('Kendaraan.destroy',$item->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin hapus?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-outline-danger btn-sm">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Data kendaraan belum tersedia
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

<script>
    function printTable(id) {
        let content = document.getElementById(id).innerHTML;
        let win = window.open('', '', 'width=900,height=700');

        win.document.write(`
        <html>
        <head>
            <title>Print</title>
            <style>
                body { font-family: Arial; }

                table {
                    width:100%;
                    border-collapse: collapse;
                }

                th, td {
                    border:1px solid #ddd;
                    padding:10px;
                    text-align:center;
                }

                th {
                    background:#198754;
                    color:white;
                }

                .no-print {
                    display:none;
                }
            </style>
        </head>
        <body>${content}</body>
        </html>
    `);

        win.document.close();
        win.print();
    }
</script>

@endsection