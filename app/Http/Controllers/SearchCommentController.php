<?php

namespace App\Http\Controllers;
use App\Models\SearchComment;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

use Illuminate\Http\Request;

class SearchCommentController extends Controller
{
    public function add($id) {
        $comment = new SearchComment();
        $comment->warrant_id = $id;
        $comment->user_id = Auth::id();
        $comment->username = Auth::user()->name;
        $comment->comment = request('comment');

        $comment->save();

        $publisher = DB::table('search_warrants')->select('publisher_id')->where('id', '=', $id)->first();
        $publisher_name = DB::table('search_warrants')->select('publisher')->where('id', '=', $id)->first();

        $notification = new Notification();
        $notification->publisher_id = $publisher->publisher_id;
        $notification->publisher = $publisher_name->publisher;
        $notification->handler_id = Auth::id();
        $notification->handler = Auth::user()->name;
        $notification->action = "added a comment to your search warrant (#$id).";
        $notification->link = "/warrants/search/details/" . $id;
        $notification->warrant_id = $id;
        $notification->save();

        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Added comment to search warrant $id";
        $log->save();
        return redirect('/warrants/search/details/' . $id);
    }
}
