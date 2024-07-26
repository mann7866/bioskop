<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail; // Sesuaikan dengan model yang digunakan

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3',
        ]);

        $query = $request->input('query');

        $items = Detail::where('judul', 'like', "%$query%")
                      ->get();

        return view('details.detail', ['items' => $items, 'query' => $query]);
    }
}
