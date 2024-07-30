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
        $validatedData = $request->validate([
            "kursi" => "required|integer|min:1|max:26", // Assuming A-Z seats
            "studio" => "required|unique:kursi,studio",
        ], [
            "kursi.required" => "Kursi Harus Diisi",
            "studio.required" => "Studio Harus Diisi",
            "studio.unique" => "Studio Sudah Ada",
        ]);

        $kursiBaru = [];
        $alphabet = range('A', 'Z');
        for ($i = 0; $i < $validatedData['kursi']; $i++) {
            $kursiBaru[] = [
                'studio' => $validatedData['studio'],
                'kursi' => $alphabet[$i],
            ];
        }

        // Save each seat to the database
        foreach ($kursiBaru as $data) {
            Kursi::create($data);
        }

        return redirect()->route("kursi.index")->with([
            "success" => "Berhasil Tambah Data",
            'kursiBaru' => $kursiBaru
        ]);
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

        $kursi = Kursi::find($id);

        $validateData = $request;

        if ($validateData['studio'] !== $kursi->studio) {
            $vakidateData = $request->validate([
                "kursi" => "required",
                "studio" => "required|unique:kursi,studio",
            ], [
                "kursi.required" => "Kursi Harus Diisi",
                "studio.required" => "Studio Harus Diisi",
                "studio.unique" => "Studio Sudah Ada",

            ]);

            $kursi->update($vakidateData);
            return redirect()->route("kursi.index")->with("success", "Berhasil Edit Data");
        } else {
            return redirect()->route("kursi.index")->with("success", "Berhasil Edit Data");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kursi = Kursi::find($id);

        $kursi->delete();
        return redirect()->route("kursi.index")->with("success", "Berhasil Delete");
    }
}
