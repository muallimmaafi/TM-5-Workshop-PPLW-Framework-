@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title mb-4">
            Menu - {{ $vendor->name }}
        </h4>

        <a href="{{ route('menus.create', $vendor->id) }}"
            class="btn btn-success mb-3">
            + Tambah Menu
        </a>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->name }}</td>
                    <td>Rp {{ number_format($menu->price) }}</td>
                    <td>
                        <a href="{{ route('menus.edit', [$vendor->id, $menu->id]) }}"
                            class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('menus.destroy', [$vendor->id, $menu->id]) }}"
                            method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin hapus menu?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        <br>

        <a href="{{ route('vendors.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </div>
</div>

@endsection