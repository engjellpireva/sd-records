<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function index(Request $request) {
        $keyword = request()->query('keyword');
        if(request()->query('keyword')) {
            $logs = DB::table('logs')->where('username', 'LIKE', "%{$keyword}%")->orWhere('action', 'LIKE', "%{$keyword}%")->orderBy('created_at', 'desc')->simplePaginate(15);
        } else {
            $logs = DB::table('logs')->orderBy('created_at', 'desc')->simplePaginate(15);
        }
        return view('logs', ['logs' => $logs]);
    }
}
