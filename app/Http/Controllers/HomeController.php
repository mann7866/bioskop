<?php

namespace App\Http\Controllers;

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
    // public function search(Request $request)
    // {
    //     $query = $request->input('query');
    //     $films = Film::where('title', 'like', "%{$query}%")
    //         ->orWhere('description', 'like', "%{$query}%")
    //         ->get();

    //     return view('search-results', compact('films'));
    // }
    public function index()
    {
        return view('home');
    }
}
