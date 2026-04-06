@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title">Daftar Pesanan Kantin</h4>

            <a href="{{ route('orders.selectVendor') }}" class="btn btn-sm btn-primary">
                + Tambah Pesanan
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($orders as $order)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        Rp {{ number_format($order->total_price) }}
                    </td>

                    <td>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>
                        @elseif($order->status == 'paid')
                            <span class="badge bg-success">
                                Paid
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                {{ $order->status }}
                            </span>
                        @endif
                    </td>

                    <td>

                        @if($order->status == 'pending')

                        <a href="{{ route('orders.pay', $order->id) }}"
                           class="btn btn-success btn-sm">
                            Bayar
                        </a>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center">
                        Belum ada pesanan
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>
</div>

@endsection