@extends('layouts.app')
@section('content')

<div class="card p-4">

    <h4>
        {{ $user ? 'Edit User' : 'Tambah User' }}
    </h4>

    <form method="POST"
        action="{{ $user ? route('user.update',$user->id) : route('user.store') }}">

        @csrf

        @if($user)
        @method('PUT')
        @endif

        <!-- NAMA -->
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control"
                value="{{ old('name', $user->name ?? '') }}">
        </div>

        <!-- EMAIL -->
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                value="{{ old('email', $user->email ?? '') }}">
        </div>

        <!-- PASSWORD -->
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <small>Kosongkan jika tidak ingin mengganti password</small>
        </div>

        <!-- ROLE -->
        <div class="mb-3">
            <label>Role</label>

            <select name="role" class="form-control" id="roleSelect">
                <option value="admin" {{ ($user->role ?? '')=='admin'?'selected':'' }}>Admin</option>
                <option value="petugas" {{ ($user->role ?? '')=='petugas'?'selected':'' }}>Petugas</option>
                <option value="owner" {{ ($user->role ?? '')=='owner'?'selected':'' }}>Owner</option>
            </select>
        </div>

        <!-- SHIFT (WAJIB ADA name="shift") -->
        <div class="mb-3" id="shiftBox">
            <label>Shift</label>

            <select name="shift" id="shiftSelect" class="form-control">
                <option value="">-- Pilih Shift --</option>

                <option value="pagi" {{ ($user->shift ?? '')=='pagi'?'selected':'' }}>Pagi</option>
                <option value="siang" {{ ($user->shift ?? '')=='siang'?'selected':'' }}>Siang</option>
                <option value="malam" {{ ($user->shift ?? '')=='malam'?'selected':'' }}>Malam</option>
            </select>
        </div>

        <!-- STATUS -->
        <div class="mb-3">
            <label>Status</label>

            <select name="status" class="form-control" id="statusSelect">
                <option value="aktif" {{ ($user->status ?? '')=='aktif'?'selected':'' }}>Aktif</option>
                <option value="nonaktif" {{ ($user->status ?? '')=='nonaktif'?'selected':'' }}>Nonaktif</option>
            </select>
        </div>

        <button class="btn btn-primary">
            {{ $user ? 'Update' : 'Simpan' }}
        </button>

    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const roleSelect = document.getElementById("roleSelect");
        const shiftSelect = document.getElementById("shiftSelect");
        const shiftBox = document.getElementById("shiftBox");
        const statusSelect = document.getElementById("statusSelect");

        function toggleShift() {
            let role = roleSelect.value;

            if (role === "petugas") {
                shiftBox.style.display = "block";
                shiftSelect.disabled = false;
            } else {
                shiftBox.style.display = "none";
                shiftSelect.disabled = true;
                shiftSelect.value = "";
            }
        }

        function updateStatus() {
            let role = roleSelect.value;

            if (role !== "petugas") return;

            let shift = shiftSelect.value;
            let hour = new Date().getHours();

            let status = "nonaktif";

            if (shift === "pagi") {
                status = (hour >= 6 && hour < 14) ? "aktif" : "nonaktif";
            } else if (shift === "siang") {
                status = (hour >= 14 && hour < 22) ? "aktif" : "nonaktif";
            } else if (shift === "malam") {
                status = (hour >= 22 || hour < 6) ? "aktif" : "nonaktif";
            }

            statusSelect.value = status;
        }

        roleSelect.addEventListener("change", toggleShift);
        shiftSelect.addEventListener("change", updateStatus);

        toggleShift();
    });
</script>

@endsection