@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">

            <!-- HEADER -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Data Area Parkir</h4>

                <div class="d-flex gap-2">
                    <button onclick="printTable('areaTable')" class="btn btn-success btn-sm">
                        <i class="mdi mdi-printer"></i> Print
                    </button>

                    <a href="{{ route('Area.form') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-plus"></i> Tambah Area
                    </a>
                </div>
            </div>

            <!-- BODY -->
            <div class="card-body">

                <div class="table-responsive" id="areaTable">
                    <table class="table table-editable table-nowrap align-middle table-edits">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Area Kendaraan</th>
                                <th>Kapasitas</th>
                                <th>Terisi</th>
                                <th class="no-print">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($area as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <strong>{{ $item->nama_area }}</strong>
                                </td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ $item->kapasitas }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-success">
                                        {{ $terisiPerArea[$item->id] ?? 0 }}/{{ $item->kapasitas }}
                                    </span>
                                </td>

                                <td class="no-print">
                                    <a href="{{ url('Area/create?id=' . $item->id) }}"
                                        class="btn btn-outline-warning btn-sm">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    <form action="{{ route('Area.destroy',$item->id) }}"
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
                                <td colspan="5" class="text-center text-muted">
                                    Data area belum tersedia
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
                    background:#0dcaf0;
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