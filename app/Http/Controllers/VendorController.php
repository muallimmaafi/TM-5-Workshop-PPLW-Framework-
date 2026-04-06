<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();

        return view('vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Vendor::create([
            'name' => $request->name
        ]);

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor berhasil ditambahkan');
    }

    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $vendor = Vendor::findOrFail($id);
        $vendor->update([
            'name' => $request->name
        ]);

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor berhasil diupdate');
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor berhasil dihapus');
    }

}
