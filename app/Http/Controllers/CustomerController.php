<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Menu;

class CustomerController extends Controller
{
    public function vendors()
    {
        $vendors = Vendor::all();

        return view('vendors', compact('vendors'));
    }

    public function menus($id)
    {
        $vendor = Vendor::findOrFail($id);
        $menus = Menu::where('vendor_id', $id)->get();

        return view('menus.index', compact('vendor', 'menus'));
    }
}
