<?php

namespace App\Http\Controllers;

use App\Http\Requests\TanggalRequest;
use App\Models\tanggal;
use Illuminate\Http\Request;

class TanggalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tanggal = Tanggal::all();
        return view("dates.tanggal", compact("tanggal"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dates.tanggalCreate");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TanggalRequest $request)
    {
        tanggal::create($request->validated());
        return redirect()->route("tanggal.index")->with('success','Berhasil Tambah Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(tanggal $tanggal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TanggalRequest $tanggal)
    {

        return view("dates.tanggalEdit", compact( "tanggal"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TanggalRequest $request, Tanggal $tanggal)
    {
        // Update record menggunakan data dari request yang telah divalidasi
        $tanggal->update([
            'tanggalTayang' => $request->input('tanggalTayang'),
        ]);

        // Redirect ke daftar tanggal dengan pesan sukses
        return redirect()->route('tanggal.index')->with('success', 'Tanggal Tayang updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TanggalRequest $tanggal)
    {
        $tanggal = Tanggal::find($tanggal);

        $tanggal->delete();
            return redirect()->route('tanggal.index')->with('success', 'Tanggal Tayang updated successfully');


    }
}
