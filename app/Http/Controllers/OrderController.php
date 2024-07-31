<?php

namespace App\Http\Controllers;

use App\Models\Kursi;
use App\Models\Order;
use App\Models\Detail;
use App\Models\Studio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail = Detail::all();

        $order = Order::all();
        return view("orders.order", compact("detail",  "order"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    public function order($id)
    {
        $detail = Detail::find($id);
        $kursi = Kursi::pluck('kursi');
        $studio = Studio::pluck('studio','id');

        // dd($id);
            return view('orders.createOrder', compact('detail', 'kursi', 'studio'));
    }
    




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validateData = $request->validate([

            'jumlah_tiket' => 'required|integer|min:1', // Contoh validasi jumlah_tiket
            'total_harga' => 'required|min:0|numeric',
            'id_detail' => '',
            'pembayaran' => '',
            'id_studio' => 'required',

        ],[
            'jumlah_tiket.required'=> 'Jumlah Tiket Harus Diisi',
            'jumlah_tiket.min'=> 'Jumlah Tiket Minimal 1',
            'total_harga.min'=> 'Jumlah Tiket Minimal 0',
            'total_harga.required'=> 'Total Harga Harus Diisi',
            'total_harga.numeric'=> 'Total Harga Harus Abjad',
            'id_studio.required' => 'Studio Harus Dipilih',
        ]);

        Order::create($validateData);
        return redirect()->route("home")->with("success", "Berhasil Pesan Tiket");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detail = Detail::find($id);
        $order = Order::find($id);

        return view("details.pembayaran", compact("order", "detail"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $order = Order::find($id);
        $validateData = $request->validate([

            'jumlah_tiket' => 'required|integer|min:1', // Contoh validasi jumlah_tiket
            'total_harga' => 'required|min:0|numeric',
            'id_detail' => '',
            'pembayaran' => 'required|numeric',

        ],[
            'pembayaran.required'=> 'Pembauyaran Tidak Boleh Kosong',
            'pembayaran.numeric'=> 'Pembauyaran Harus Angka',
            'jumlah_tiket.required'=> 'Jumlah Tiket Harus Diisi',
            'jumlah_tiket.min'=> 'Jumlah Tiket Minimal 1',
            'total_harga.min'=> 'Jumlah Tiket Minimal 0',
            'total_harga.required'=> 'Total Harga Harus Diisi',
            'total_harga.numeric'=> 'Total Harga Harus Abjad',
        ]);

        if ($validateData['pembayaran'] >= $order->total_harga) {

            $kembalian = $validateData['pembayaran'] - $order->total_harga;

            // Simpan kembalian ke dalam database
            $validateData['kembalian'] = $kembalian;

            $order->update($validateData);
            return redirect()->route("order.index")->with("success", "Berhasil Pesan Tiket");
        }
        return redirect()->route("pembayaran", $order->id)->with("gagal", "Pembayaran Tidak Boleh Kurang Dari Total Bayar");
        // if ($validateData['pembayaran'] > $order->total_harga) {

        //     $order->update($validateData);
        //     return redirect()->route("home")->with("success", "Berhasil Pesan Tiket");

        // }
    }

    // OrderController.php
    public function paid(string $id)
    {
        $order = Order::find($id);

        $order->update([
            'status' => 'paid'
        ]);

        return redirect()->route("pembayaran", $order->id);
    }

    public function cancel(string $id)
    {
        $order = Order::find($id);

        $order->update([
            'status' => 'cancel'
        ]);

        return redirect()->route("order.index")->with('cancel', "Berhasil Cancel Pesanan");
    }

    private function getBadgeClass($status)
    {
        switch ($status) {
            case 'paid':
                return 'badge text-bg-success';
            case 'cancel':
                return 'badge text-bg-danger';
            default:
                return 'badge badge-bg-secondary';
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Order::find($id)->delete();
        return redirect()->route("order.index")->with("success", "Berhasil Membatalkan Pesanan");
    }
}
