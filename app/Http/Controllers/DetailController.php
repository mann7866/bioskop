<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Models\genre;
use App\Models\Kursi;
use App\Models\Detail;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail = Detail::with('genres')->get();
        $genres = genre::all();
        $time = Time::all();
        return view("details.detail", compact("detail", "time"     ));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genre = Genre::all();
        $time = Time::all();
        return view("details.createDetail", compact("genre", "time"));
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
            "harga"=> "required|max:10000000000",
            "genres" => "required|array", // Assuming 'genre' is an array of genre IDs
            "id_jamTayang" => "required",
        ]);

        // Upload and save the image
        if ($request->hasFile("foto")) {
            $image = $request->file("foto");
            $imageName = time() . "_" . $image->getClientOriginalName();
            $image->move(public_path("image"), $imageName);
        }

        // Create new Detail instance
        $detail = Detail::create([
            'judul' => $validateData['judul'],
            'pemeran' => $validateData['pemeran'],
            'tanggalRilis' => $validateData['tanggalRilis'],
            'penulis' => $validateData['penulis'],
            'sutradara' => $validateData['sutradara'],
            'perusahaanProduksi' => $validateData['perusahaanProduksi'],
            'foto' => $imageName, // Assign the uploaded image name
            'deskripsi' => $validateData['deskripsi'],
            'harga'=> $validateData['harga'],
            "id_jamTayang" => $validateData ["id_jamTayang"],

        ]);

        // Sync genres with the detail using 'sync'
        if ($request->has('genres')) {
            $genres = $request->input('genres');
            $detail->genres()->sync($genres);
        }
        return redirect()->route("detail")->with("success", "Berhasil Tambah Detail");
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

        $genre = Genre::all();
        return view("details.editDetail", compact("detail", "genre"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Temukan detail berdasarkan ID atau lemparkan pengecualian jika tidak ditemukan
        $detail = Detail::findOrFail($id);

        // Validasi data dari request
        $validatedData = $request->validate([
            "judul" => "required|max:20|unique:detail,judul,$id|regex:/^[a-zA-Z\s]+$/",
            "pemeran" => "required|max:20|regex:/^[a-zA-Z\s]+$/",
            "tanggalRilis" => "required",
            "penulis" => "required|max:20|regex:/^[a-zA-Z\s]+$/",
            "sutradara" => "required|max:20|regex:/^[a-zA-Z\s]+$/",
            "perusahaanProduksi" => "required|regex:/^[a-zA-Z\s]+$/|max:20",
            "foto" => "sometimes|required|mimes:jpeg,jpg,png,gif|max:2048",
            "deskripsi" => "required|max:50",
            "harga"=> "required",
            "id_jamTayang" => "required",

        ]);

        // Handle file foto jika ada di request
        if ($request->hasFile("foto")) {
            $image = $request->file("foto");
            $imageName = time() . "_" . $image->getClientOriginalName();
            $image->move(public_path("image"), $imageName);

            // Hapus foto lama jika ada dan perbarui nama foto baru
            if ($detail->foto) {
                $oldImagePath = public_path('image/') . $detail->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $detail->foto = $imageName;
        }

        // Update data detail
        $detail->update([
            'judul' => $validatedData['judul'],
            'pemeran' => $validatedData['pemeran'],
            'tanggalRilis' => $validatedData['tanggalRilis'],
            'penulis' => $validatedData['penulis'],
            'sutradara' => $validatedData['sutradara'],
            'perusahaanProduksi' => $validatedData['perusahaanProduksi'],
            'deskripsi' => $validatedData['deskripsi'],
            'harga'=> $validatedData['harga'],
            "id_jamTayang" => $validatedData ["id_jamTayang"],

        ]);

        // Sinkronisasi genres jika ada yang dipilih
        if ($request->has('genres')) {
            $genres = $request->input('genres');
            $detail->genres()->sync($genres);
        }

        // Redirect dengan pesan sukses setelah berhasil update
        return redirect()->route("detail")->with("success", "Berhasil Update Detail");
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
