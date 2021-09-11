<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Changelog;
use App\Models\Log;

class ChangeLogController extends Controller
{
    public function index() {
        $changelogs = Changelog::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('changelog', ['changelogs' => $changelogs]);
    }

    public function add(Request $request) {
        $changelog = new Changelog();
        $changelog->publisher = Auth::user()->name;
        $changelog->publisher_id = Auth::id();
        $changelog->body = request('body');

        $changelog->save();

        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Created a new changelog";
        $log->save();
        return redirect('/changelog');
    }
}
