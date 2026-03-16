@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <h4>Wilayah (AJAX)</h4>

        <br>

        <div class="form-group mb-3">
            <label>Provinsi</label>
            <select id="provinsi" class="form-control">
                <option value="">Pilih Provinsi</option>

                @foreach($provinsi as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="form-group mb-3">
            <label>Kota / Kabupaten</label>
            <select id="kota" class="form-control">
                <option value="">Pilih Kota</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Kecamatan</label>
            <select id="kecamatan" class="form-control">
                <option value="">Pilih Kecamatan</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Kelurahan</label>
            <select id="kelurahan" class="form-control">
                <option value="">Pilih Kelurahan</option>
            </select>
        </div>

    </div>
</div>

@endsection


@push('js-page')

<script>

$(document).ready(function(){

    // PROVINSI → KOTA
    $('#provinsi').change(function(){

        let id = $(this).val()

        $('#kota').html('<option value="">Loading...</option>')
        $('#kecamatan').html('<option value="">Pilih Kecamatan</option>')
        $('#kelurahan').html('<option value="">Pilih Kelurahan</option>')

        $.ajax({

            url: "/get-kota/" + id,
            type: "GET",

            success:function(data){

                let html = '<option value="">Pilih Kota</option>'

                data.forEach(function(item){

                    html += `<option value="${item.id}">
                                ${item.name}
                             </option>`

                })

                $('#kota').html(html)

            }

        })

    })


    // KOTA → KECAMATAN
    $('#kota').change(function(){

        let id = $(this).val()

        $('#kecamatan').html('<option value="">Loading...</option>')
        $('#kelurahan').html('<option value="">Pilih Kelurahan</option>')

        $.ajax({

            url: "/get-kecamatan/" + id,
            type: "GET",

            success:function(data){

                let html = '<option value="">Pilih Kecamatan</option>'

                data.forEach(function(item){

                    html += `<option value="${item.id}">
                                ${item.name}
                             </option>`

                })

                $('#kecamatan').html(html)

            }

        })

    })


    // KECAMATAN → KELURAHAN
    $('#kecamatan').change(function(){

        let id = $(this).val()

        $('#kelurahan').html('<option value="">Loading...</option>')

        $.ajax({

            url: "/get-kelurahan/" + id,
            type: "GET",

            success:function(data){

                let html = '<option value="">Pilih Kelurahan</option>'

                data.forEach(function(item){

                    html += `<option value="${item.id}">
                                ${item.name}
                             </option>`

                })

                $('#kelurahan').html(html)

            }

        })

    })


})

</script>

@endpush