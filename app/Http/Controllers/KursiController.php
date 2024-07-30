<?php

namespace App\Http\Controllers;

use App\Models\Kursi;
use Illuminate\Http\Request;

class KursiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kursi = Kursi::all();
        // $studios = Kursi::select('studio')->distinct()->get();
    
        return view("chairs.kursi", compact("kursi"));
    }

    // app/Http/Controllers/KursiController.php
   



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("chairs.kursiCreate");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vakidateData = $request->validate([
            "kursi"=> "required|unique:kursi,kursi",
            "studio"=> "required|unique:kursi,studio",
        ]);

        Kursi::create($vakidateData);
        return redirect()->route("kursi.index")->with("success","Berhasil Tambah Data");
    }

    /**
     * Display the specified resource.
     */
    public function show(kursi $kursi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $kursi = Kursi::find($id);

        return view("chairs.kursiEdit", compact("kursi"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vakidateData = $request->validate([
            "kursi"=> "required|unique:kursi,kursi",
            "studio"=> "required|unique:kursi,studio",
        ]);

        $kursi = Kursi::find($id);

        $kursi->update($vakidateData);
        return redirect()->route("chairs.index")->with("success","Berhasil Edit Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kursi = Kursi::find($id);
    
        if (!$kursi) {
            return redirect()->route("kursi.index")->with("error", "Kursi tidak ditemukan.");
        }
    
        $kursi->delete();
        return redirect()->route("kursi.index")->with("success", "Berhasil Delete");
    }
    
}
