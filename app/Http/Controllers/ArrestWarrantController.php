<?php

namespace App\Http\Controllers;
use App\Models\ArrestWarrant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Log;
use App\Models\Notification;

class ArrestWarrantController extends Controller
{
    public function show() {
        return view('arrest_warrants.create');
    }

    public function create(Request $request) {
        $arrest_warrant = new ArrestWarrant();
        $arrest_warrant->publisher = Auth::user()->name;
        $arrest_warrant->publisher_id = Auth::id();
        $arrest_warrant->name = request('name');
        $arrest_warrant->alias = request('alias');
        $arrest_warrant->age = request('age');
        $arrest_warrant->gender = request('gender');
        $arrest_warrant->race = request('race');
        $arrest_warrant->number = request('number');
        $arrest_warrant->description = request('description');
        $arrest_warrant->date = request('date');
        $arrest_warrant->narrative = request('narrative');
        $arrest_warrant->type = request('type');
        $arrest_warrant->active = 1;

        $arrest_warrant->save();

        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Created arrest warrant for " . request('name');
        $log->save();
        $inserted_id = $log->id;
        return redirect('/warrants/arrest/pending')->with('message', 'Arrest Warrant created successfully.');
    }

    public function pendingWarrants() {
        $arrest_warrants = ArrestWarrant::where('active', '=', 1)->get();
        return view('arrest_warrants.pending', ['warrants' => $arrest_warrants]);
    }

    public function activeWarrants() {
        $arrest_warrants = ArrestWarrant::where('active', '=', 2)->get();
        return view('arrest_warrants.active', ['warrants' => $arrest_warrants]);
    }

    public function closedWarrants() {
        $arrest_warrants = ArrestWarrant::where('active', '=', 0)->get();
        return view('arrest_warrants.closed', ['warrants' => $arrest_warrants]);
    }

    public function warrantDetails($id) {
        $arrest_warrant = ArrestWarrant::findOrFail($id);
        $comments = DB::table('arrest_comments')->where('warrant_id', '=', $id)->get();
        return view('arrest_warrants.details', ['warrant' => $arrest_warrant], ['comments' => $comments]);
    }

    public function warrantClose($id) {
        $arrest_warrant = ArrestWarrant::findOrFail($id);
        $arrest_warrant->active = 0;
        $arrest_warrant->save();

        $publisher = DB::table('arrest_warrants')->select('publisher_id')->where('id', '=', $id)->first();
        $publisher_name = DB::table('arrest_warrants')->select('publisher')->where('id', '=', $id)->first();

        $notification = new Notification();
        $notification->publisher_id = $publisher->publisher_id;
        $notification->publisher = $publisher_name->publisher;
        $notification->handler_id = Auth::id();
        $notification->handler = Auth::user()->name;
        $notification->action = "closed your arrest warrant (#$id).";
        $notification->link = "/warrants/arrest/details/" . $id;
        $notification->warrant_id = $id;
        $notification->save();
        
        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Changed status of warrant #$id to Closed.";
        $log->save();
        return redirect('/warrants/arrest/details/' . $id);
    }

    public function warrantApprove($id) {
        $arrest_warrant = ArrestWarrant::findOrFail($id);
        $arrest_warrant->active = 2;
        $arrest_warrant->save();

        $publisher = DB::table('arrest_warrants')->select('publisher_id')->where('id', '=', $id)->first();
        $publisher_name = DB::table('arrest_warrants')->select('publisher')->where('id', '=', $id)->first();

        $notification = new Notification();
        $notification->publisher_id = $publisher->publisher_id;
        $notification->publisher = $publisher_name->publisher;
        $notification->handler_id = Auth::id();
        $notification->handler = Auth::user()->name;
        $notification->action = "approved your arrest warrant (#$id).";
        $notification->link = "/warrants/arrest/details/" . $id;
        $notification->warrant_id = $id;
        $notification->save();

        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Changed status of warrant #$id to Approved.";
        $log->save();
        return redirect('/warrants/arrest/details/' . $id);
    }
}
