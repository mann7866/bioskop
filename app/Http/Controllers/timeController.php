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

            "jam_mulai"=> "required|unique:time,jam_mulai",
            "jam_selesai"=> "required|unique:time,jam_selesai|after:jam_mulai",
        ],[

            "jam_mulai.required"=> "Jam mulai Harus Diisi",
            "jam_mulai.unique"=> "Jam mulai Sudah Ada",
           
            "jam_selesai.required"=> "Jam selesai Harus Diisi",
            "jam_selesai.unique"=> "Jam selesai Sudah Ada",
            'jam_selesai.after' => 'Jam Selesai harus setelah Jam Mulai',

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
        $detail = Detail::all();
        return view("times.editTime", compact("time", "detail"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $time = Time::find($id);
          $validateData = $request;

            $validateData = $request->validate([

                "jam_mulai"=> "required",
                "jam_selesai"=> "required|after:jam_mulai",
            ],[

                "jam_mulai.required"=> "Jam mulai Harus Diisi",

                "jam_mulai.date_format"=> "Jam mulai Harus Lewat Dari Jam Sekarang",
                "jam_selesai.required"=> "Jam selesai Harus Diisi",

                'jam_selesai.after' => 'Jam Selesai harus setelah Jam Mulai',
                "jam_mulai.selesai"=> "Jam Selesai Harus Setelah Jam Mulai",
            ]) ;
            $time->update($validateData);
            return redirect()->route("time")->with("success","Berhasil Edit Waktu Tayang");




    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $time = Time::find($id);
        $timeCount = $time->details()->count();

        if ($timeCount > 0) {
            return redirect()->route("time")->with('gagal', 'Waktu Tidak Dapat diHapus Karena Masih Berkaitan Dengan Film.');
        }
       $time->delete();
            return redirect()->route("time")->with("delete","Berhasil Menghapus waktu");


    }
}
