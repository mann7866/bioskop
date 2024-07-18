<?php

namespace App\Http\Controllers;

use App\Models\genre;
use App\Models\Detail;
use App\Models\Genres;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genres::all();
        $genre = genre::all();
        $detail = detail::all();
        return view("kumpulanGenre.genres", compact("genres","genre", "detail"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genre = genre::all();
        $detail = Detail::all();
        return view("kumpulanGenre.createGenres", compact("genre","detail"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "id_judul"=> "required",
            "id_genre"=> "required",
        ]);

        Genres::create($validateData);
        return redirect()->route("genres")->with("success","Berasil Menambah Genre");
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
        $genres = Genres::find($id);
        return view("kumpulanGenre.editGenres", compact("genre"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            "id_judul"=> "required",
            "id_genre"=> "required",
        ]);


        $genres = Genres::find($id);

        $genres->update($validateData);
        return redirect()->route("genres")->with("success","Berasil Menambah Genre");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genres = Genres::find($id);

        $genres->delete();
        return redirect()->route("genres")->with("success","Berhasil Delete");
    }
}
