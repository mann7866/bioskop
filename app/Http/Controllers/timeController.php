<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Models\Detail;
use Illuminate\Http\Request;

class timeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $time = Time::all();
        $detail = Detail::all();
        // dd("", $detail);
        return view("times.time", compact("time", "detail"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detail = Detail::all();
        return view("times.createTime", compact("detail"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "id_judul"=>"required",
            "jamTayang"=> "required|unique:time,jamTayang",
            "tanggalTayang"=> "required|after:yesterday|date_format:Y-m-d",
        ],[
            "id_judul.required"=> "Judul Harus Diisi",
            "jamTayang.required"=> "Jam Tayang Harus Diisi",
            "jamTayang.unique"=> "Jam Tayang Sudah Ada",
            "tanggalTayang.required"=> "Tanggal Tayang Harus Diisi",
            "tanggalTayang.after"=> "Tanggal Tayang Tidak Boleh Kurang Dari Hari Imi",
            "tanggalTayang.date_format"=> "Tanggal Tayang Harus Y-m-d",
        ]) ;

        Time::create($validateData);
        return redirect()->route("time")->with("success","Berhasil Tambah waktu");

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
        $time = Time::find($id);
        return view("times.editTime", compact("time"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $time = Time::find($id);

        $validateData = $request;

        if ($validateData['tanggalTayang'] !== $time->tanggalTayang) {
        $validateData = $request->validate([
            "id_judul"=>"required",
            "jamTayang"=> "required|unique:time,jamlTayang",
            "tanggalTayang"=> "required",
            ],[
                "id_judul.required"=> "Judul Harus Diisi",
                "jamTayang.required"=> "Jam Tayang Harus Diisi",
                "jamTayang.unique"=> "Jam Tayang Sudah Ada",
                "tanggalTayang.required"=> "Tanggal Tayang Harus Diisi",
                "tanggalTayang.after"=> "Tanggal Tayang Tidak Boleh Kurang Dari Hari Imi",
                "tanggalTayang.date_format"=> "Tanggal Tayang Harus Y-m-d",
            ]) ;
        $time->update($validateData);
            return redirect()->route("time")->with("success","Berhasil Edit Waktu Tayang");
        }else{
            return redirect()->route("time")->with("success","Berhasil Edit Waktu Tayang");
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $time = Time::find($id);
$time->delete();
            return redirect()->route("time")->with("delete","Berhasil Menghapus waktu");


    }
}
