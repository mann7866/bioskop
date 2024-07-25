<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Detail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //  me

    public function index()
    {
        $detail = Detail::paginate(12);
        $berita = Berita::paginate(3);

        return view('home', compact('detail', 'berita'));
    }



    
}

