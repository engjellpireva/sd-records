<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\User;
use App\Models\Log;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index() {
        return view('admin.home');
    }

    public function user_create() {
        return view('admin.user_create');
    }

    public function role_create() {
        return view('admin.role_create');
    }

    public function role_create_insert(Request $request) {
        $role = Role::create(['name' => request('roleName')]);
        return view('admin.role_create')->with('success', 'Successfully created role ' . request('name'));
    }

    public function user_create_insert(Request $request) {
        $user = new User();
        $user->name = request('name');
        $user->password = Hash::make(request('password'));
        $user->save();

        $log = new Log();
        $log->user_id = Auth::id();
        $log->username = Auth::user()->name;
        $log->action = "Created user " . request('name');
        $log->save();

        if(request('role') === "Supervisor") {
            $user->assignRole('Supervisor');
        } else if(request('role') === "Administrator") {
            $user->assignRole('Administrator');
        }

        return redirect('/admin');
    }

    public function user_manage(Request $request) {
        $user = request()->query('user');
        if($user) {
            $users = DB::table('users')->where('name', 'LIKE', "%{$user}%")->orderBy('created_at', 'asc')->simplePaginate(15);
        } else {
            $users = DB::table('users')->orderBy('created_at', 'asc')->simplePaginate(15);
        }
        return view('admin.user_manage', ['users' => $users]);
    }

    public function user_edit($id) {
        $user = User::findOrFail($id);
        return view('admin.user_edit', ['user' => $user]);
    }

    public function user_edit_insert(Request $request, $id) {
        $user = User::where('id', '=', $id)->first();
        
        if($request->name) {
            $user->name = $request->name;
            $user->save();
        } else if($request->password) {
            $user->password = Hash::make(request('password'));
            $user->save();
        }
        
        $user->assignRole(request('role'));
        $user->save();
        return redirect('/admin/user/manage/' . $id)->with('success', 'Successfully updated user.');
    }

    public function user_delete($id) {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect('/admin/user/manage')->with('success', 'User deleted successfully.');
    }
}
