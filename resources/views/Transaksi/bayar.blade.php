<button id="pay-button" class="btn btn-primary">Bayar Rp {{ number_format($transaksi->biaya_total,0,',','.') }}</button>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                // redirect ke route bayarSukses
                window.location.href = '{{ route("Transaksi.bayarSukses", $transaksi->id) }}';
            },
            onPending: function(result) {
                console.log('Pending:', result);
            },
            onError: function(result) {
                console.log('Error:', result);
            }
        });
    });
</script>