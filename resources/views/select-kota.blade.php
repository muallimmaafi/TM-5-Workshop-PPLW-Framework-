@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                <h5>Select</h5>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label>Kota</label>
                    <input type="text" id="kota" class="form-control">
                </div>

                <button class="btn btn-success mb-3" id="btnTambah">
                    Tambahkan
                </button>

                <div class="mb-3">
                    <label>Select Kota</label>
                    <select id="selectKota" class="form-control">
                        <option value="">-- pilih kota --</option>
                    </select>
                </div>

                <div>
                    <b>Kota Terpilih:</b>
                    <span id="hasilKota"></span>
                </div>

            </div>
        </div>

    </div>


    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                <h5>Select 2</h5>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label>Select Kota</label>

                    <select id="selectKota2" class="form-control select2">
                        <option value="">-- pilih kota --</option>
                    </select>

                </div>

                <div>
                    <b>Kota Terpilih:</b>
                    <span id="hasilKota2"></span>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection

@push('style-page')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js-page')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {

        // aktifkan select2
        //$('.select2').select2();

        // tombol tambah kota
        $('#btnTambah').on('click', function(e) {
            e.preventDefault();

            let kota = $('#kota').val().trim();

            if (kota === "") {
                alert("Nama kota tidak boleh kosong");
                return;
            }

            // buat option baru untuk masing-masing select
            let option1 = new Option(kota, kota, false, false);
            let option2 = new Option(kota, kota, false, false);

            // tambahkan ke select biasa
            $('#selectKota').append(option1);

            // tambahkan ke select2
            $('#selectKota2')
                .append(option2)
                .trigger('change');

            // kosongkan input
            $('#kota').val("");
        });

        // ketika select biasa berubah
        $('#selectKota').on('change', function() {
            let kota = $(this).val();
            $('#hasilKota').text(kota);
        });

        // ketika select2 berubah
        $('#selectKota2').on('change', function() {
            let kota = $(this).val();
            $('#hasilKota2').text(kota);
        });

    });
</script>
@endpush