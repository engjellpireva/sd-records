<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        $pending = DB::table('arrest_warrants')->where('active', '=', 1)->get();
        $active = DB::table('arrest_warrants')->where('active', '=', 2)->get();
        $closed = DB::table('arrest_warrants')->where('active', '=', 0)->get();
        $user = DB::table('users')->where('id', '=', Auth::id())->first();
        return view('home', ['pending' => $pending, 'active' => $active, 'closed' => $closed, 'user' => $user]);
    }

    public function myWarrants()
    {
        $arrest_warrants = DB::table('arrest_warrants')->where('publisher_id', '=', Auth::id())->simplePaginate(15);
        $search_warrants = DB::table('search_warrants')->where('publisher_id', '=', Auth::id())->simplePaginate(15);
        return view('my_warrants', ['arrest_warrants' => $arrest_warrants, 'search_warrants' => $search_warrants]);
    }
}
