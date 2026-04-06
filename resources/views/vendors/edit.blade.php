@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title mb-4">Edit Vendor</h4>

        <form action="{{ route('vendors.update', $vendor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Nama Vendor</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ $vendor->name }}"
                       required>
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('vendors.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

@endsection