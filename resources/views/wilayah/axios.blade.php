@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <h4>Wilayah Indonesia (Axios)</h4>

        <br>

        <div class="form-group mb-3">
            <label>Provinsi</label>
            <select id="provinsi" class="form-control">

                <option value="0">Pilih Provinsi</option>

                @foreach($provinsi as $p)
                <option value="{{$p->id}}">
                    {{$p->name}}
                </option>
                @endforeach

            </select>
        </div>

        <div class="form-group mb-3">
            <label>Kota / Kabupaten</label>
            <select id="kota" class="form-control">
                <option value="0">Pilih Kota</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Kecamatan</label>
            <select id="kecamatan" class="form-control">
                <option value="0">Pilih Kecamatan</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Kelurahan</label>
            <select id="kelurahan" class="form-control">
                <option value="0">Pilih Kelurahan</option>
            </select>
        </div>

    </div>
</div>

@endsection


@push('js-page')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.getElementById('provinsi').addEventListener('change', function() {

        let id = this.value

        document.getElementById('kota').innerHTML =
            '<option value="0">Pilih Kota</option>'

        document.getElementById('kecamatan').innerHTML =
            '<option value="0">Pilih Kecamatan</option>'

        document.getElementById('kelurahan').innerHTML =
            '<option value="0">Pilih Kelurahan</option>'


        axios.get('/get-kota/' + id)

            .then(function(response) {

                let data = response.data

                data.forEach(function(kota) {

                    document.getElementById('kota').innerHTML +=
                        `<option value="${kota.id}">${kota.name}</option>`

                })

            })

    })



    document.getElementById('kota').addEventListener('change', function() {

        let id = this.value

        document.getElementById('kecamatan').innerHTML =
            '<option value="0">Pilih Kecamatan</option>'

        document.getElementById('kelurahan').innerHTML =
            '<option value="0">Pilih Kelurahan</option>'


        axios.get('/get-kecamatan/' + id)

            .then(function(response) {

                let data = response.data

                data.forEach(function(kec) {

                    document.getElementById('kecamatan').innerHTML +=
                        `<option value="${kec.id}">${kec.name}</option>`

                })

            })

    })



    document.getElementById('kecamatan').addEventListener('change', function() {

        let id = this.value

        document.getElementById('kelurahan').innerHTML =
            '<option value="0">Pilih Kelurahan</option>'


        axios.get('/get-kelurahan/' + id)

            .then(function(response) {

                let data = response.data

                data.forEach(function(kel) {

                    document.getElementById('kelurahan').innerHTML +=
                        `<option value="${kel.id}">${kel.name}</option>`

                })

            })

    })
</script>

@endpush