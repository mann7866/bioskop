<?php

namespace App\Http\Controllers;

use App\Models\Kursi;
use App\Models\Order;
use App\Models\Detail;
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
        $kursi =  Kursi::all();
        return view("orders.order", compact("detail", "kursi"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $kursi = Kursi::all();

        return view('nama_view')->with('kursi', $kursi);
    }

    public function order($id)
    {

        $detail = Detail::find($id);
$kursi = Kursi::all();

        return view('orders.createOrder', compact('detail','kursi'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validateData = $request->validate([
            "judul"=> "required",
            "genre"=> "required",
            "id_kursi"=> "required",
            "harga"=> "required",
        ]);

        Order::create ([$validateData]);
        return redirect()->route("order")->with("success","Berhasil Pesan Tiket");


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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Order::find($id)->delete();
        return redirect()->route("order")->with("success","Berhasil Membatalkan Pesanan");
    }
}
