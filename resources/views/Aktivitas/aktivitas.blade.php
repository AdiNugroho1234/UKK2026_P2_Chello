@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">

            <!-- HEADER -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Log Aktivitas Sistem</h4>

                <button onclick="printTable('logTable')" class="btn btn-success btn-sm">
                    <i class="bi bi-printer"></i> Print
                </button>
            </div>

            <!-- BODY -->
            <div class="card-body">

                <div class="table-responsive" id="logTable">
                    <table class="table table-nowrap align-middle">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu</th>
                                <th>User</th>
                                <th>Aktivitas</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($log as $index => $l)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($l->waktu_aktivitas)->format('d M Y, H:i') }}
                                </td>

                                <td>
                                    <strong>{{ $l->name ?? '-' }}</strong>
                                </td>

                                <td>
                                    {{ $l->aktivitas }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Belum ada aktivitas
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

<!-- PRINT SCRIPT -->
<script>
    function printTable(id) {
        let content = document.getElementById(id).innerHTML;
        let win = window.open('', '', 'width=900,height=700');

        win.document.write(`
        <html>
        <head>
            <title>Log Aktivitas</title>
            <style>
                body {
                    font-family: Arial;
                    padding: 20px;
                }

                h3 {
                    text-align: center;
                    margin-bottom: 20px;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: center;
                }

                th {
                    background: #198754;
                    color: white;
                }
            </style>
        </head>
        <body>
            <h3>Log Aktivitas Sistem</h3>
            ${content}
        </body>
        </html>
    `);

        win.document.close();
        win.print();
    }
</script>

@endsection