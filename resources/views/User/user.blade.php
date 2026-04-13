@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 style="color:#6f42c1;font-weight:600">Data User</h4>
        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm no-print">
            Tambah User
        </a>
    </div>

    <!-- ================= OWNER ================= -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Table User - Owner</h4>

            <button onclick="printSection('ownerTable')" class="btn btn-sm btn-primary no-print">
                Print
            </button>
        </div>

        <div class="card-body table-responsive" id="ownerTable">
            <table class="table table-edits align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="no-print">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($owner as $u)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <span class="badge bg-success">{{ ucfirst($u->status) }}</span>
                        </td>
                        <td class="no-print">
                            <a href="{{ route('user.edit',$u->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('user.delete',$u->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Data kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= ADMIN ================= -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Table User - Admin</h4>

            <button onclick="printSection('adminTable')" class="btn btn-sm btn-primary no-print">
                Print
            </button>
        </div>

        <div class="card-body table-responsive" id="adminTable">
            <table class="table table-edits align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="no-print">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($admin as $u)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <span class="badge bg-primary">{{ ucfirst($u->status) }}</span>
                        </td>
                        <td class="no-print">
                            <a href="{{ route('user.edit',$u->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('user.delete',$u->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Data kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= PETUGAS ================= -->
    <div class="card mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="card-title mb-0">Table User - Petugas</h4>

            <div class="d-flex gap-2 no-print">

                <select id="filterShift" class="form-control form-control-sm" style="width:140px;">
                    <option value="">Semua Shift</option>
                    <option value="pagi">Pagi</option>
                    <option value="siang">Siang</option>
                    <option value="malam">Malam</option>
                </select>

                <button onclick="printSection('petugasTable')" class="btn btn-sm btn-primary">
                    Print
                </button>

            </div>

        </div>

        <div class="card-body table-responsive" id="petugasTable">

            <table class="table table-edits align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Shift</th>
                        <th>Status</th>
                        <th class="no-print">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($petugas as $u)
                    <tr class="row-data" data-shift="{{ $u->shift }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ ucfirst($u->shift) }}</td>
                        <td>
                            <span class="badge bg-warning text-dark">{{ ucfirst($u->status) }}</span>
                        </td>
                        <td class="no-print">
                            <a href="{{ route('user.edit',$u->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('user.delete',$u->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Data kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

<script>
    // FILTER SHIFT PETUGAS
    document.getElementById("filterShift").addEventListener("change", function() {
        let val = this.value;

        document.querySelectorAll(".row-data").forEach((row) => {
            let s = row.getAttribute("data-shift");
            row.style.display = !val || val === s ? "" : "none";
        });
    });

    // PRINT FUNCTION
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
                    background:#6f42c1;
                    color:white;
                }

                th:last-child,
                td:last-child {
                    display: none;
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