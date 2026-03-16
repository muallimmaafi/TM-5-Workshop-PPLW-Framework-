@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <h4>Transaksi Kasir (AXIOS)</h4>

        <div class="row">

            <div class="col-md-3">
                <label>Kode Barang</label>
                <input type="text" id="kode_barang" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Nama Barang</label>
                <input type="text" id="nama_barang" class="form-control" readonly>
            </div>

            <div class="col-md-2">
                <label>Harga</label>
                <input type="text" id="harga_barang" class="form-control" readonly>
            </div>

            <div class="col-md-2">
                <label>Jumlah</label>
                <input type="number" id="jumlah" value="1" class="form-control">
            </div>

            <div class="col-md-2">
                <br>
                <button id="btnTambah" class="btn btn-success" disabled>
                    Tambahkan
                </button>
            </div>

        </div>

        <hr>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody id="keranjang"></tbody>

        </table>

        <h4>Total : <span id="total">0</span></h4>

        <button id="btnBayar" class="btn btn-primary">
            Bayar
        </button>

    </div>
</div>

@endsection

@push('js-page')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        let keranjang = []

        // ENTER CARI BARANG
        $('#kode_barang').keypress(function(e) {

            if (e.which == 13) {

                let kode = $(this).val()

                axios.get('/get-barang/' + kode)

                    .then(function(response) {

                        let data = response.data

                        if (data) {

                            $('#nama_barang').val(data.nama_barang)
                            $('#harga_barang').val(data.harga)
                            $('#jumlah').val(1)

                            $('#btnTambah').prop('disabled', false)

                        }

                    })

                    .catch(function(error) {

                        console.log(error)

                    })

            }

        })

        // TAMBAH BARANG
        $('#btnTambah').click(function() {

            let kode = $('#kode_barang').val()
            let nama = $('#nama_barang').val()
            let harga = parseInt($('#harga_barang').val())
            let jumlah = parseInt($('#jumlah').val())

            let subtotal = harga * jumlah

            let index = keranjang.findIndex(x => x.kode === kode)

            if (index !== -1) {

                keranjang[index].jumlah += jumlah
                keranjang[index].subtotal =
                    keranjang[index].harga * keranjang[index].jumlah

            } else {

                keranjang.push({
                    kode: kode,
                    nama: nama,
                    harga: harga,
                    jumlah: jumlah,
                    subtotal: subtotal
                })

            }

            renderTable()

        })

        // RENDER TABLE
        function renderTable() {

            let html = ''
            let total = 0

            keranjang.forEach(function(item, i) {

                html += `
<tr>
<td>${item.kode}</td>
<td>${item.nama}</td>
<td>${item.harga}</td>
<td>${item.jumlah}</td>
<td>${item.subtotal}</td>
<td>
<button onclick="hapus(${i})"
class="btn btn-danger btn-sm">
Hapus
</button>
</td>
</tr>
`

                total += item.subtotal

            })

            $('#keranjang').html(html)

            $('#total').text(total)

        }

        // HAPUS
        window.hapus = function(i) {

            keranjang.splice(i, 1)

            renderTable()

        }

        // BAYAR
        $('#btnBayar').click(function() {

            let total = $('#total').text()

            axios.post('/simpan-transaksi', {

                    items: keranjang,
                    total: total

                })

                .then(function() {

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Transaksi berhasil disimpan'
                    })

                    location.reload()

                })

                .catch(function(error) {

                    console.log(error)

                })

        })

    })
</script>

@endpush