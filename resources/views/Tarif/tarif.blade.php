@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">

            <!-- HEADER -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Data Tarif Parkir</h4>

                <div class="d-flex gap-2 no-print">

                    <a href="{{ route('Tarif.form') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-plus"></i> Tambah
                    </a>

                    <!-- 🔥 PRINT BUTTON -->
                    <button onclick="printSection('tarifTable')" class="btn btn-success btn-sm">
                        <i class="mdi mdi-printer"></i> Print
                    </button>

                </div>
            </div>

            <!-- BODY -->
            <div class="card-body" id="tarifTable">

                <div class="table-responsive">
                    <table class="table table-editable table-nowrap align-middle table-edits">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Kendaraan</th>
                                <th>Tarif / Jam</th>
                                <th width="120" class="no-print">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($tarif as $index => $item)
                            <tr>

                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <strong>{{ $item->jenis_kendaraan }}</strong>
                                </td>

                                <td>
                                    <span class="badge bg-success">
                                        Rp {{ number_format($item->tarif_per_jam,0,',','.') }}
                                    </span>
                                </td>

                                <td class="no-print">
                                    <a href="{{ route('Tarif.form', $item->id) }}"
                                        class="btn btn-outline-warning btn-sm">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    <form action="{{ route('Tarif.delete',$item->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin hapus?')">

                                        @csrf

                                        <button class="btn btn-outline-danger btn-sm">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Data tarif belum tersedia
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

<!-- 🔥 PRINT SCRIPT -->
<script>
    function printSection(id) {
        let content = document.getElementById(id).innerHTML;
        let win = window.open("", "", "width=900,height=700");

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

                /* HIDE ACTION COLUMN */
                th:last-child,
                td:last-child {
                    display: none;
                }

                .badge {
                    padding:5px 10px;
                    border-radius:5px;
                    background:#198754;
                    color:white;
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