@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <h4>Pilih Vendor</h4>

        <table class="table table-bordered">
            @foreach($vendors as $vendor)
            <tr>
                <td>{{ $vendor->name }}</td>
                <td>
                    <a href="{{ route('orders.create', $vendor->id) }}"
                        class="btn btn-primary">
                        Pilih
                    </a>
                </td>
            </tr>
            @endforeach
        </table>

    </div>
</div>

@endsection