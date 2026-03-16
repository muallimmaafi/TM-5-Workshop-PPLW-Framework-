<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;

class TransaksiController extends Controller
{

    public function ajaxPage()
    {
        return view('transaksi.ajax');
    }

    public function axiosPage()
    {
        return view('transaksi.axios');
    }

    public function getBarang($kode)
    {
        $barang = Barang::where('id_barang', $kode)->first();
        return response()->json($barang);
    }

    public function simpan(Request $request)
    {

        $penjualan = new Penjualan();
        $penjualan->total = $request->total;
        $penjualan->save();

        foreach ($request->items as $item) {

            $detail = new PenjualanDetail();
            $detail->id_penjualan = $penjualan->id_penjualan;
            $detail->id_barang = $item['kode'];
            $detail->jumlah = $item['jumlah'];
            $detail->subtotal = $item['subtotal'];
            $detail->save();
        }

        return response()->json([
            'status' => 'success'
        ]);
    }
}
