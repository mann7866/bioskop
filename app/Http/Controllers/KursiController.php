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
        return view("chairs.kursi", compact("kursi"));
    }

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
            "kursi"=> "required",
        ]);

        Kursi::create($vakidateData);
        return redirect()->route("kursi")->with("success","Berhasil Tambah Data");
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

        $kursi = Kursi::all();
        return view("chairs.kursiEdit", compact("kursi"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vakidateData = $request->validate([
            "kursi"=> "required",
        ]);

        $kursi = Kursi::find($id);

        $kursi->update($vakidateData);
        return redirect()->route("kursi")->with("success","Berhasil Edit Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $kursi = Kursi::find($id);

       $kursi->delete();
       return redirect()->route("kursi")->with("success","Berhasil Delete");

    }
}
