<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("news.createBerita");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "foto_deskripsi"=> "required|mimes:jpeg,jpg,png,gif|max:2048",
            "judul"=> "required",
            "tanggal"=> "required",
            "deskripsi"=> "required",
        ]);

        if ($request->hasFile("foto_deskripsi")) {
            $image = $request->file("foto_deskripsi");
            $imageName = time() . "_" . $image->getClientOriginalName();
            $image->move(public_path("image"), $imageName);
        }

        Berita::create($validateData);
        return redirect()->route("home")->with("success","Berhasil Tambah Berita");
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
        //
    }
}
