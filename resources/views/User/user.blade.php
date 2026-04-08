@extends('layouts.app')
@section('content')

<!-- TABLE -->
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Table User</h4>

                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                    <i class="mdi mdi-plus"></i> Tambah
                </a>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-editable table-nowrap align-middle table-edits">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $u)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td data-field="name">
                                    {{ $u->name }}
                                </td>

                                <td data-field="email">
                                    {{ $u->email }}
                                </td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ ucfirst($u->role) }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('user.edit',$u->id) }}"
                                        class="btn btn-outline-warning btn-sm">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    <form action="{{ route('user.delete',$u->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Yakin hapus?')">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
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

@endsection