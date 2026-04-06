@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title mb-4">Tambah Pesanan</h4>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label>Nama Customer</label>
                <input type="text"
                       name="customer_name"
                       class="form-control"
                       placeholder="Masukkan nama customer"
                       required>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Qty</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($menus as $menu)
                    <tr>
                        <td>{{ $menu->name }}</td>

                        <td class="price">
                            {{ $menu->price }}
                        </td>

                        <td>
                            <input type="number"
                                   name="qty[{{ $menu->id }}]"
                                   class="form-control qty"
                                   min="0"
                                   value="0">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Total -->
            <h5>Total: Rp <span id="total">0</span></h5>

            <br>

            <button type="submit" class="btn btn-primary">
                Checkout
            </button>

            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

<script>
document.querySelectorAll('.qty').forEach(input => {
    input.addEventListener('input', function () {
        let total = 0;

        document.querySelectorAll('tbody tr').forEach(row => {
            let price = parseInt(row.querySelector('.price').innerText) || 0;
            let qty = parseInt(row.querySelector('.qty').value) || 0;

            total += price * qty;
        });

        document.getElementById('total').innerText = total;
    });
});
</script>

@endsection