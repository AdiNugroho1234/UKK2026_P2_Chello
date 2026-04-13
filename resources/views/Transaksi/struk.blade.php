<!DOCTYPE html>
<html>

<head>
    <title>Struk Parkir</title>
    <style>
        body {
            font-family: monospace;
            width: 280px;
            margin: auto;
            font-size: 14px;
        }

        .center {
            text-align: center;
        }

        hr {
            border: 1px dashed black;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="center">
        <h3>PARKIR APP</h3>
        <p>Struk Pembayaran</p>
    </div>

    <hr>

    <p>Plat: {{ $data->plat_kendaraan ?? '-' }}</p>
    <p>Jenis: {{ $data->jenis_kendaraan ?? '-' }}</p>
    <p>Area: {{ $data->nama_area ?? '-' }}</p>

    <hr>

    <div class="row">
        <span>Masuk</span>
        <span>
            {{ $data->waktu_masuk 
            ? \Carbon\Carbon::parse($data->waktu_masuk)->format('d/m/Y H:i') 
            : '-' }}
        </span>
    </div>

    <div class="row">
        <span>Keluar</span>
        <span>
            {{ $data->waktu_keluar 
            ? \Carbon\Carbon::parse($data->waktu_keluar)->format('d/m/Y H:i') 
            : '-' }}
        </span>
    </div>

    <div class="row">
        <span>Durasi</span>
        <span>{{ $data->durasi ?? '-' }}</span>
    </div>

    <hr>

    <div class="row bold">
        <span>Total</span>
        <span>Rp {{ number_format($data->biaya_total ?? 0,0,',','.') }}</span>
    </div>

    <div class="row">
        <span>Status</span>
        <span>{{ ucfirst($data->status_pembayaran ?? '-') }}</span>
    </div>

    <div class="row">
        <span>Metode</span>
        <span>{{ ucfirst($data->metode_pembayaran ?? '-') }}</span>
    </div>

    <hr>

    <div class="center">
        <p>Terima Kasih</p>
    </div>

</body>

<script>
    window.onload = function() {
        window.print();
        setTimeout(() => window.close(), 1000);
    }
</script>

</html>