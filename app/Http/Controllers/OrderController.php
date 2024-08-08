<?php

namespace App\Http\Controllers;

use App\Models\Kursi;
use App\Models\Order;
use App\Models\Detail;
use App\Models\Studio;
use App\Models\Time;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $detail = Detail::all();
        $studio = Studio::all();
        $kursi = Kursi::all();
        $order = Order::with('studio', 'detail', 'kursi')->get();
        // dd($order);

        return view("orders.order", compact("detail", "order", "studio", "kursi"));
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
        // $studio = Studio::where('detail');
        // $kursi = Kursi::all();
        // $time = Time::all();
        $details = Detail::with('studio.kursi')->findOrFail($id);
        return view('orders.createOrder', compact('detail', 'details'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validateData = $request->validate([
            'jumlah_tiket' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
            'id_detail' => 'required',
            'kursis' => 'required|array',
            'kursis.*' => 'unique:order_kursi,id_kursi', // Ubah kursi_table_name dan column_name sesuai dengan tabel dan kolom yang relevan
        ], [
            'jumlah_tiket.required' => 'Jumlah Tiket Harus Diisi',
            'jumlah_tiket.min' => 'Jumlah Tiket Minimal 1',
            'total_harga.min' => 'Total Harga Minimal 0',
            'total_harga.required' => 'Total Harga Harus Diisi',
            'total_harga.numeric' => 'Total Harga Harus Angka',

            'id_detail.required' => 'Detail ID Harus Diisi',
            'kursis.required' => 'Kursi yang dipilih harus diisi',
            'kursis.*.unique' => 'Kursi yang dipilih harus unik',
        ]);

        // Simpan data ke dalam tabel 'orders'
        $order = Order::create([
            'jumlah_tiket' => $validateData['jumlah_tiket'],
            'total_harga' => $validateData['total_harga'],
            'id_detail' => $validateData['id_detail'],
         
        ]);

        // Sinkronkan kursi yang dipilih jika ada
        if ($request->has('kursis')) {
            $kursis = $request->input('kursis');
            $order->kursi()->sync($kursis);
        } else {
            if ($request->has('id_kursi')) {
                $id_kursi = $request->input('id_kursi');
                $order->kursi()->sync($id_kursi);
            }
        }

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

        ], [
            'pembayaran.required' => 'Pembauyaran Tidak Boleh Kosong',
            'pembayaran.numeric' => 'Pembauyaran Harus Angka',
            'jumlah_tiket.required' => 'Jumlah Tiket Harus Diisi',
            'jumlah_tiket.min' => 'Jumlah Tiket Minimal 1',
            'total_harga.min' => 'Jumlah Tiket Minimal 0',
            'total_harga.required' => 'Total Harga Harus Diisi',
            'total_harga.numeric' => 'Total Harga Harus Abjad',
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
                return 'badge text-bg-success' + '<ion-icon name="checkmark-done-outline"></ion-icon>';
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
        // dd($id);
        return redirect()->route("order.index")->with("success", "Berhasil Menghapus Pesanan");
    }
}
