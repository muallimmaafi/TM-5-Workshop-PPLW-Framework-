@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title mb-4">
            Edit Menu - {{ $vendor->name }}
        </h4>

        <form action="{{ route('menus.update', [$vendor->id, $menu->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Nama Menu</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ $menu->name }}"
                       required>
            </div>

            <div class="form-group mb-3">
                <label>Harga</label>
                <input type="number"
                       name="price"
                       class="form-control"
                       value="{{ $menu->price }}"
                       required>
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('menus.index', $vendor->id) }}"
               class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

@endsection