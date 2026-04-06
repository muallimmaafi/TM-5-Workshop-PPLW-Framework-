@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title mb-4">Pembayaran Pesanan</h4>

        <table class="table table-bordered mb-4">
            <tr>
                <th>ID Pesanan</th>
                <td>{{ $order->id }}</td>
            </tr>

            <tr>
                <th>Nama Customer</th>
                <td>{{ $order->customer_name }}</td>
            </tr>

            <tr>
                <th>Total Harga</th>
                <td>
                    Rp {{ number_format($order->total_price,0,',','.') }}
                </td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    <span class="badge badge-warning">
                        {{ $order->status }}
                    </span>
                </td>
            </tr>
        </table>

        <button id="pay-button" class="btn btn-success">
            Bayar Sekarang
        </button>

    </div>
</div>

@endsection


@section('scripts')

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script>
    document.getElementById('pay-button').onclick = function() {

        snap.pay('{{ $snapToken }}', {

            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                window.location.href = "/orders/success/{{ $order->id }}";
            },

            onPending: function(result) {
                alert("Menunggu pembayaran");
            },

            onError: function(result) {
                alert("Pembayaran gagal");
            },

            onClose: function() {
                alert('Kamu menutup popup tanpa menyelesaikan pembayaran');
            }

        });

    };
</script>

@endsection