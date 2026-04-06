<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Vendor;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index($vendor)
    {
        $vendor = Vendor::findOrFail($vendor);
        $menus = Menu::where('vendor_id', $vendor->id)->get();

        return view('menus.index', compact('vendor', 'menus'));
    }

    public function create($vendor)
    {
        $vendor = Vendor::findOrFail($vendor);

        return view('menus.create', compact('vendor'));
    }

    public function store(Request $request, $vendor)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        Menu::create([
            'vendor_id' => $vendor,
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('menus.index', ['vendor' => $vendor])
            ->with('success', 'Menu berhasil ditambahkan');
    }

    public function edit($vendor_id, $menu_id)
    {
        $vendor = Vendor::findOrFail($vendor_id);
        $menu = Menu::findOrFail($menu_id);

        return view('menus.edit', compact('vendor', 'menu'));
    }

    public function update(Request $request, $vendor_id, $menu_id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $menu = Menu::findOrFail($menu_id);

        $menu->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('menus.index', ['vendor' => $vendor_id])
            ->with('success', 'Menu berhasil diupdate');
    }

    public function destroy($vendor_id, $menu_id)
    {
        $menu = Menu::findOrFail($menu_id);
        $menu->delete();

        return redirect()->route('menus.index', ['vendor' => $vendor_id])
            ->with('success', 'Menu berhasil dihapus');
    }
}
