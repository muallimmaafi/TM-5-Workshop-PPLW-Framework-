<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Village;

class WilayahController extends Controller
{
    public function ajaxPage()
    {
        $provinsi = Province::all();
        return view('wilayah.ajax', compact('provinsi'));
    }

    public function axiosPage()
    {
        $provinsi = Province::all();
        return view('wilayah.axios', compact('provinsi'));
    }

    public function getKota($province_id)
    {
        $kota = City::where('province_id', $province_id)->get();
        return response()->json($kota);
    }

    public function getKecamatan($city_id)
    {
        $kecamatan = District::where('regency_id', $city_id)->get();
        return response()->json($kecamatan);
    }

    public function getKelurahan($district_id)
    {
        $kelurahan = Village::where('district_id', $district_id)->get();
        return response()->json($kelurahan);
    }
}