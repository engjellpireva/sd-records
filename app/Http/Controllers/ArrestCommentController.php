<?php

namespace App\Http\Controllers;
use App\Models\ArrestComment;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

use Illuminate\Http\Request;

class ArrestCommentController extends Controller
{
    public function add($id) {
        $comment = new ArrestComment();
        $comment->warrant_id = $id;
        $comment->user_id = Auth::id();
        $comment->username = Auth::user()->name;
        $comment->comment = request('comment');

        $comment->save();

        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Added comment " .request('comment'). " to arrest warrant #$id";
        $log->save();
        return redirect('/warrants/arrest/details/' . $id);
    }
}
