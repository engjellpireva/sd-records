<?php

namespace App\Http\Controllers;
use App\Models\SearchWarrant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Log;

class SearchWarrantController extends Controller
{
    public function show() {
        return view('search_warrants.create');
    }

    public function create(Request $request) {
        $search_warrant = new SearchWarrant();
        $search_warrant->publisher = Auth::user()->name;
        $search_warrant->publisher_id = Auth::id();
        $search_warrant->property = request('address');
        $search_warrant->items = request('items');
        $search_warrant->narrative = request('narrative');
        $search_warrant->active = 1;
        $search_warrant->save();

        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Created search warrant for " . request('name');
        $log->save();
        
        return redirect('/warrants/search/pending')->with('message', 'Search Warrant created successfully.');
    }

    public function pendingWarrants() {
        $search_warrants = SearchWarrant::where('active', '=', 1)->get();

        return view('search_warrants.pending', ['warrants' => $search_warrants]);
    }

    public function activeWarrants() {
        $search_warrants = SearchWarrant::where('active', '=', 2)->get();
        return view('search_warrants.active', ['warrants' => $search_warrants]);
    }

    public function closedWarrants() {
        $search_warrants = SearchWarrant::where('active', '=', 0)->get();
        return view('search_warrants.closed', ['warrants' => $search_warrants]);
    }

    public function warrantDetails($id) {
        $search_warrants = SearchWarrant::findOrFail($id);
        $comments = DB::table('search_comments')->where('warrant_id', '=', $id)->get();
        return view('search_warrants.details', ['warrant' => $search_warrants], ['comments' => $comments]);
    }

    public function warrantClose($id) {
        $search_warrants = SearchWarrant::findOrFail($id);
        $search_warrants->active = 0;
        $search_warrants->save();

        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Changed status of warrant #$id to Closed.";
        $log->save();

        return redirect('/warrants/search/details/' . $id);
    }

    public function warrantApprove($id) {
        $search_warrants = SearchWarrant::findOrFail($id);
        $search_warrants->active = 2;
        $search_warrants->save();

        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Changed status of warrant #$id to Approved.";
        $log->save();
        return redirect('/warrants/search/details/' . $id);
    }
}
