<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail = Detail::all();
        return view("details.detail", compact("detail"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("details.createDetail");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "judul" => "required|max:20|unique:detail,judul|regex:/^[a-zA-Z\s]+$/",
            "pemeran" => "required|max:20|regex:/^[a-zA-Z\s]+$/",
            "tanggalRilis" => "required",
            "penulis" => "required|max:20|regex:/^[a-zA-Z\s]+$/",
            "sutradara" => "required|max:20|regex:/^[a-zA-Z\s]+$/",
            "perusahaanProduksi" => "required|regex:/^[a-zA-Z\s]+$/|max:20",
            "foto" => "required|mimes:jpeg,jpg,png,gif|max:2048",
            "deskripsi" => "required|max:50",
        ]);

        $detail = Detail::create($validateData);

        if ($request->hasFile("foto")) {
            $image = $request->file("foto");
            $imageName = time() . "_" . $image->getClientOriginalName();
            $image->move(public_path("image"), $imageName);

            $detail->foto = $imageName;
            if ($detail->save()) {
                return redirect()->route("detail")->with("success", "Berhasil Tambah Detail");
            }
        }
    }

    /**
     * Display the specified re source.
     */
    public function show(Detail $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detail = Detail::find($id);
        return view("details.editDetail", compact("detail"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $detail = Detail::findOrFail($id);
        $validateData = $request;


        if ($validateData['judul'] !== $detail->judul) {
            $validateData = $request->validate([
                "judul" => "required|max:20|unique:detail,judul|regex:/^[a-zA-Z\s]+$/",
                "pemeran" => "required|max:20|regex:/^[a-zA-Z\s]+$/",
                "tanggalRilis" => "required",
                "penulis" => "required|max:20|regex:/^[a-zA-Z\s]+$/",
                "sutradara" => "required|max:20|regex:/^[a-zA-Z\s]+$/",
                "perusahaanProduksi" => "required|regex:/^[a-zA-Z\s]+$/|max:20",
                "foto" => "required|mimes:jpeg,jpg,png,gif|max:2048",
                "deskripsi" => "required|max:50",
            ]);

            $detail->update($validateData);
        }
            if ($request->hasFile("foto")) {
                $image = $request->file("foto");
                $imageName = time() . "_" . $image->getClientOriginalName();
                $image->move(public_path("image"), $imageName);


                if ($detail->foto) {
                    $oldImagePath = public_path('image/') . $detail->foto;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $detail->foto = $imageName;
            }

            if ($detail->save()) {
                return redirect()->route("detail")->with("success", "Berhasil Tambah Detail");
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detail = Detail::findOrFail($id);

        if ($detail->foto) {
            $imagePath = public_path('image') . '/' . $detail->foto;

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $detail->delete();

        return redirect()->route("detail")->with("delete", "Berhasil Menghapus Detail");
    }
}
