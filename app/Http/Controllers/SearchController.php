<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $films = Film::where('judul', 'LIKE', "%{$query}%")->get();

        return view('search.results', compact('films', 'query'));
    }
}
