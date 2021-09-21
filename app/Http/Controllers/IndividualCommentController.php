<?php

namespace App\Http\Controllers;

use App\Models\IndividualComment;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

use Illuminate\Http\Request;

class IndividualCommentController extends Controller
{
    public function add($id) {
        $comment = new IndividualComment();
        $comment->individual_id = $id;
        $comment->user_id = Auth::id();
        $comment->username = Auth::user()->name;
        $comment->comment = request('comment');

        $publisher = DB::table('individuals')->select('publisher_id')->where('id', '=', $id)->first();
        $publisher_name = DB::table('individuals')->select('publisher')->where('id', '=', $id)->first();

        $notification = new Notification();
        $notification->publisher_id = $publisher->publisher_id;
        $notification->publisher = $publisher_name->publisher;
        $notification->handler_id = Auth::id();
        $notification->handler = Auth::user()->name;
        $notification->action = "added a comment to your individual (#$id).";
        $notification->link = "/individuals/view/" . $id;
        $notification->warrant_id = $id;
        $notification->save();

        $comment->save();
        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Added comment " .request('comment'). " to individual #$id";
        $log->save();
        return redirect('/individuals/view/' . $id);
    }
}
