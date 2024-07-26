<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Detail;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail = Detail::paginate(12);
        $berita = Berita::paginate(6);

        return view('news.berita', compact('detail', 'berita'));
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
            "foto_deskripsi" => "required|mimes:jpeg,jpg,png,gif|max:2048",
            "judul" => "required",
            "tanggal" => "required",
            "deskripsi" => "required",
        ]);

        if ($request->hasFile("foto_deskripsi")) {
            $imageBerita = $request->file("foto_deskripsi");
            $imageName = time() . "_" . $imageBerita->getClientOriginalName();
            $imageBerita->move(public_path("imageBerita"), $imageName);


            $validateData['foto_deskripsi'] = $imageName;
        }

        Berita::create($validateData);
        return redirect()->route("berita")->with("success", "Berhasil Tambah Berita");
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
        $berita = Berita::find($id);

        return view('news.editberita', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $berita = Berita::find($id);

        // Handle upload file gambar baru jika ada
        if ($request->hasFile("foto_deskripsi")) {
            $imageBerita = $request->file("foto_deskripsi");
            $imageName = time() . "_" . $imageBerita->getClientOriginalName();
            $imageBerita->move(public_path("imageBerita"), $imageName);

            // Hapus foto_deskripsi lama jika ada dan perbarui nama foto_deskripsi baru
            if ($berita->foto_deskripsi) {
                $oldImagePath = public_path('imageBerita/') . $berita->foto_deskripsi;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $berita->foto_deskripsi = $imageName;
        }

        // Validasi data hanya jika judul berubah
        if ($request->input('judul') !== $berita->judul) {
            $request->validate([
                "foto_deskripsi" => "required|mimes:jpeg,jpg,png,gif|max:2048",
                "judul" => "required",
                "tanggal" => "required",
                "deskripsi" => "required",
            ]);
        } else {
            // Jika judul tidak berubah, hanya validasi tanggal dan deskripsi
            $request->validate([
                "tanggal" => "required",
                "deskripsi" => "required",

            ]);
        }

        // Update data berita setelah validasi berhasil
        $berita->update([
            'judul' => $request->input('judul'),
            'tanggal' => $request->input('tanggal'),
            'deskripsi' => $request->input('deskripsi'),
            // foto_deskripsi sudah diupdate jika ada file baru
        ]);

        return redirect()->route("berita")->with("success", "Berhasil Update berita");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $berita =  Berita::findOrFail($id);

        if ($berita->foto_deskripsi) {
            $imagePath = public_path('imageBerita') . '/' . $berita->foto_deskripsi;

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $berita->delete();
        return redirect()->route("berita")->with("success", "Berhasil Update berita");
    }
}