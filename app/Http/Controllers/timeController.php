<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Http\Request;

class timeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $time = Time::all();
        return view("times.time", compact("time"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("times.createTime");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "id_judul"=>"required",
            "jamTayang"=> "required|unique:time,jamlTayang",
            "tanggalTayang"=> "required|after:yesterday|date_format:Y-m-d",
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

        $timeCount = $time->detail->count();

        if ($timeCount > 0) {
            return redirect()->route("time")->with("delete","Gagal Menghapus waktu Karena Masih Bersangkutan Dengan Film");
        }

        if($time->delete()){
            return redirect()->route("time")->with("delete","Berhasil Menghapus waktu");
        }

    }
}
