<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use View;

class PopulateNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user_id = Auth::id();
        if($user_id) {
            $notifs = DB::table('notifications')->where('publisher_id', '=', Auth::id())->orderBy('created_at', 'desc')->get();
            $request->notifications = $notifs;
            View::share('notifications', $request->notifications);
        }
        return $next($request);
    }
}
