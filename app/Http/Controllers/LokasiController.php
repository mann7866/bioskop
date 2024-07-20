<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasi = Lokasi::all();
        return view("locations.lokasi", compact("lokasi"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("locations.lokasiCreate");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vakidateData = $request->validate([
            "studio"=> "required",
            "kursi"=> "required",
        ]);

        Lokasi::create($vakidateData);
        return redirect()->route("lokasi")->with("success","Berhasil Tambah Data");
    }

    /**
     * Display the specified resource.
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $lokasi = Lokasi::find($id);

        $lokasi = Lokasi::all();
        return view("locations.lokasiEdit", compact("lokasi"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vakidateData = $request->validate([
            "studio"=> "required",
            "kursi"=> "required",
        ]);

        $lokasi = Lokasi::find($id);

        $lokasi->update($vakidateData);
        return redirect()->route("lokasi")->with("success","Berhasil Edit Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $lokasi = lokasi::find($id);

       $lokasi->delete();
       return redirect()->route("lokasi")->with("success","Berhasil Delete");

    }
}
