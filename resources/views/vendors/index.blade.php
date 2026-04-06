@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title mb-3">Pilih Vendor Kantin</h4>

        <a href="{{ route('vendors.create') }}" class="btn btn-success mb-3">
            + Tambah Vendor
        </a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Vendor</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->id }}</td>
                    <td>{{ $vendor->name }}</td>

                    <td>
                        <a href="{{ url('/vendors/'.$vendor->id.'/menus') }}"
                            class="btn btn-sm btn-primary">
                            Lihat Menu
                        </a>

                        <a href="{{ route('vendors.edit', $vendor->id) }}"
                            class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('vendors.destroy', $vendor->id) }}"
                            method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin hapus vendor?')">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection