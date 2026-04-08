@extends('layouts.app')
@section('title', $user ? 'Edit User' : 'Tambah User')

@section('content')

<!-- PAGE TITLE -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">
                {{ $user ? 'Edit User' : 'Tambah User' }}
            </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item active">
                        {{ $user ? 'Edit' : 'Tambah' }}
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- FORM -->
<div class="row">
    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">
                    {{ $user ? 'Edit Data User' : 'Tambah Data User' }}
                </h4>

                <form method="POST"
                    action="{{ $user ? route('user.update',$user->id) : route('user.store') }}">
                    @csrf

                    <!-- NAMA -->
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $user->name ?? '') }}"
                            required>

                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $user->email ?? '') }}"
                            required>

                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                            name="password"
                            class="form-control">

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti password
                        </small>

                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- ROLE -->
                    <div class="mb-3">
                        <label class="form-label">Role</label>

                        <select name="role" class="form-select" required>
                            <option value="admin" {{ old('role',$user->role ?? '')=='admin'?'selected':'' }}>
                                Admin
                            </option>

                            <option value="petugas" {{ old('role',$user->role ?? '')=='petugas'?'selected':'' }}>
                                Petugas
                            </option>

                            <option value="owner" {{ old('role',$user->role ?? '')=='owner'?'selected':'' }}>
                                Owner
                            </option>
                        </select>
                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex justify-content-between">

                        <button class="btn btn-primary">
                            {{ $user ? 'Update' : 'Simpan' }}
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection