<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studio = Studio::all();
        return view("studios.studio", compact("studio"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("studios.studioCreate");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "studio" => "required",
        ]);

        Studio::create($validateData);
        return redirect()->route('studio')->with("success", "Berhasil Tambah Studio");
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
        $Studio = Studio::find($id);
        return view("studios.studioEdit", compact("studio"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $studio = Studio::find($id);
        $validateData = $request;

        if ($validateData['studio'] !== $studio->studio) {

            $validateData = $request->validate([
                "studio" => "required",
            ]);

            $studio->update($validateData);
            return redirect()->route("studio")->with("success", "Berhasil Edit Studio");
        } else {
            return redirect()->route("studio")->with("success", "Berhasil Edit Studio");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $studio = Studio::find($id);
        $studio->delete();
        return redirect()->route("studio")->with("success", "Berhasil Menghapus Studio");
    }
}
