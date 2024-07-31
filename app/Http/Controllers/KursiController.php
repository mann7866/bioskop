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
        $validatedData = $request->validate([
            "kursi" => "required|integer|min:1|max:26", // Assuming A-Z seats
            "studio" => "required",
        ], [
            "kursi.required" => "Kursi Harus Diisi",
            "studio.required" => "Studio Harus Diisi",
        ]);

        // Check if the studio already has seats and delete them
        $existingSeats = Kursi::where('studio', $validatedData['studio'])->get();
        if ($existingSeats->isNotEmpty()) {
            foreach ($existingSeats as $seat) {
                $seat->delete();
            }
        }

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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kursi = Kursi::find($id);
        $studio = $kursi->studio;
        $kursiStudio = Kursi::where('studio', $studio)->get();
    
        return view("chairs.kursiEdit", compact("kursi", "kursiStudio", "studio"));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kursi = Kursi::find($id);
        $studio = $kursi->studio;

        $validateData = $request->validate([
            "kursi" => "required|integer|min:1|max:26", // Assuming A-Z seats
            "studio" => "required|unique:kursi,studio," . $studio . ",studio",
        ], [
            "kursi.required" => "Kursi Harus Diisi",
            "studio.required" => "Studio Harus Diisi",
            "studio.unique" => "Studio Sudah Ada",
        ]);

        // Update kursi
        Kursi::where('studio', $studio)->delete();

        $kursiBaru = [];
        $alphabet = range('A', 'Z');
        for ($i = 0; $i < $validateData['kursi']; $i++) {
            $kursiBaru[] = [
                'studio' => $validateData['studio'],
                'kursi' => $alphabet[$i],
            ];
        }

        foreach ($kursiBaru as $data) {
            Kursi::create($data);
        }
        
        return redirect()->route("kursi.index")->with("success", "Berhasil Edit Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kursi = Kursi::findOrFail($id);
        $studio = $kursi->studio;
        Kursi::where('studio', $studio)->delete();
        
        return redirect()->route("kursi.index")->with("success", "Berhasil Delete");
    }
}
