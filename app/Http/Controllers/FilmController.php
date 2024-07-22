<?php

namespace App\Http\Controllers;

use App\Models\genre;
use App\Models\Detail;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        $detail = Detail::with('genres')->get();
        $genres = genre::all();
        return view("details.film", compact("detail"));
    }
}
