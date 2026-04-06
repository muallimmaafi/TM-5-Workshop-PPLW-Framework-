<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Menu;
use App\Models\Vendor;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function pay($id)
    {
        $order = Order::findOrFail($id);

        // Midtrans Config
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id . '-' . time(),
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name ?? 'Guest',
            ]
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return view('orders.pay', compact('snapToken', 'order'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function selectVendor()
    {
        $vendors = Vendor::all();
        return view('orders.select_vendor', compact('vendors'));
    }

    public function create($vendor)
    {
        $menus = Menu::where('vendor_id', $vendor)->get();

        return view('orders.create', compact('menus', 'vendor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required'
        ]);

        $total = 0;
        $items = [];

        foreach ($request->qty as $menu_id => $qty) {
            if ($qty > 0) {
                $menu = Menu::find($menu_id);

                $subtotal = $menu->price * $qty;
                $total += $subtotal;

                $items[] = [
                    'id' => $menu->id,
                    'price' => $menu->price,
                    'quantity' => $qty,
                    'name' => $menu->name,
                ];
            }
        }

        if ($total == 0) {
            return back()->with('error', 'Pilih minimal 1 menu');
        }

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'total_price' => $total,
            'status' => 'pending'
        ]);

        session(['order_items' => $items]);

        return redirect()->route('orders.pay', $order->id);
    }

    public function success($id)
    {
        $order = Order::findOrFail($id);

        $order->status = 'paid';
        $order->save();

        return redirect()->route('orders.index')
            ->with('success', 'Pembayaran berhasil!');
    }
}
