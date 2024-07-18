<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Film;
use App\Models\Time;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Film = Film::all();
        $detail = Detail::all();
        $time = Time::all();
        return view("films.film");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("films.filmCreate");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "id_genre"=> "required",
            "judul"=> "required",
            "id_jamTayang"=> "required",
            "tanggalTayang"=> "required",
            "id_deskripsi"=> "required",
            "harga"=> "required|max:1000000000",
        ]) ;

            Film::create($validateData) ;
            return redirect()->route("film")->with('success', 'Berhasil Tambah Film') ;
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
