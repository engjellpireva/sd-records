<?php

namespace App\Http\Controllers;
use App\Models\SearchComment;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

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

        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Added comment to search warrant $id";
        $log->save();
        return redirect('/warrants/search/details/' . $id);
    }
}
