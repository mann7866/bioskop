<?php

namespace App\Http\Controllers;

use App\Models\Kursi;
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
        $kursi = Kursi::all();
        return view("studios.studioCreate", compact('kursi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "studio" => "required|unique:studio,studio",
            "id_kursi" => "nullable|array"
        ], [
            "studio.required" => "Studio Harus Diisi",
            "studio.unique" => "Studio Sudah Ada",
            "id_kursi.array" => "Pilih setidaknya satu kursi"
        ]);

        $studio = Studio::create([
            'studio' => $validateData['studio']
        ]);

        // Attach kursi ke studio, misalnya jika relasi many-to-many
        if (isset($validateData['id_kursi'])) {
            $studio->kursi()->sync($validateData['id_kursi']);
        }

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
                "studio" => "required|unique:studio,studio",
            ],[
                "studio.required"=> "Studio Harus Diisi",
                "studio.unique"=> "Studio Sudaj Ada",
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
        $studioCount =$studio->kursi->count();
        if ($studioCount > 0) {
            return redirect()->route("studio")->with("gagal", "Gagal Menghapus Studio Karena Masih Berkaitan Dengan Kursi");
        }
        $studio->delete();
        return redirect()->route("studio")->with("success", "Berhasil Menghapus Studio");
    }
}
