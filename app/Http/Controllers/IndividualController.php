<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Log;
use App\Models\Notification;
use App\Models\Individual;

class IndividualController extends Controller
{
    public function show() {
        return view('individuals.create');
    }

    public function create(Request $request) {
        $individual = new Individual();
        $individual->publisher = Auth::user()->name;
        $individual->publisher_id = Auth::id();
        $individual->name = request('name');
        $individual->image = request('image');
        $individual->alias = request('alias');
        $individual->age = request('age');
        $individual->address = request('address');
        $individual->gender = request('gender');
        $individual->race = request('race');
        $individual->number = request('number');
        $individual->description = request('description');
        $individual->gang = request('gang');

        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Created individual " . $individual->name;
        $log->save();
        
        $individual->save();
        return redirect('/individuals/view');
    }

    public function view(Request $request) {
        $keyword = request()->query('keyword');

        if(request()->query('keyword')) {
            $individuals = DB::table('individuals')->where('name', 'LIKE', "%${keyword}%")->orWhere('publisher', 'LIKE', "%${keyword}%")->orderBy('created_at', 'desc')->simplePaginate(15);
        } else {
            $individuals = Individual::orderBy('created_at', 'desc')->simplePaginate(15);
        }
        return view('individuals.view', ['individuals' => $individuals]);
    }

    public function details ($id) {
        $individual = Individual::findOrFail($id);
        $comments = DB::table('individual_comments')->where('individual_id', '=', $id)->get();
        return view('individuals.details', ['individual' => $individual, 'comments' => $comments]);
    }

    public function edit ($id) {
        $individual = Individual::findOrFail($id);
        return view('individuals.edit', ['individual' => $individual]);
    }

    public function edit_insert($id) {
        $individual = Individual::findOrFail($id);
        $individual->publisher = Auth::user()->name;
        $individual->publisher_id = Auth::id();
        $individual->name = request('name');
        $individual->image = request('image');
        $individual->alias = request('alias');
        $individual->age = request('age');
        $individual->address = request('address');
        $individual->gender = request('gender');
        $individual->race = request('race');
        $individual->number = request('number');
        $individual->description = request('description');
        $individual->gang = request('gang');

        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Edited individual " . $individual->name;
        $log->save();
        
        $individual->save();
        return redirect('/individuals/view/' . $id)->with('success', 'Successfully updated individual #'.$id);
    }
}
