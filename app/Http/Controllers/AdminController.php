<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Flash;
use Validator;
use Auth;
use Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read-module-admins')->only('index');
        $this->middleware('permission:create-module-admins')->only(['create', 'store']);
        $this->middleware('permission:update-module-admins')->only(['edit', 'update']);
        $this->middleware('permission:delete-module-admins')->only('destroy');
    }

    public function index(Request $request)
    {
        $admins = User::whereHas('user_role.role', function($q) {
            $q->whereIn('name', Auth::user()->allowed_roles('read'));
        })
        ->whereHas('user_role.role.mode_role.mode', function($q) {
            $q->where('name', 'admin');
        })
        ->where(function($q) use ($request) {
            $q->whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($request->search).'%']);
            $q->orWhereRaw('LOWER(email) LIKE ?', ['%'.strtolower($request->search).'%']);
        })
        ->paginate(20);

        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        $admin = new User();
        $roles = Role::whereIn('name', Auth::user()->allowed_roles('create'))
            ->whereHas('mode_role.mode', function($q) {
                $q->where('name', 'admin');
            })
            ->pluck('display_name', 'id');
        $role = null;

        return view('admin.form', compact('admin', 'roles', 'role'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'role' => 'required|in:'.implode(',', array_keys(Auth::user()->allowed_roles('create')))
        ]);

        $password = str_random(8) . substr(str_shuffle('~!@#$%^&*()'), 0, 2);

        if($validate->fails()) {
            return ['errors' => $validate->errors()];
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->save();

        $user->attachRole($request->role);

        // LARAVEL SEND THE EMAIL
        event(new UserCreated(compact('user', 'password')));

        Flash::success(sprintf('You\'ve successfully created the %s account.', $user->name));
        return ['errors' => false];
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $admin = User::find($id);
        $roles = Role::whereIn('name', Auth::user()->allowed_roles('update'))
            ->whereHas('mode_role.mode', function($q) {
                $q->where('name', 'admin');
            })
            ->pluck('display_name', 'id');
        $role = $admin->roles->first()->id;

        return view('admin.form', compact('admin', 'roles', 'role'));
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => "required|email|unique:users,email,$id,id|max:255",
            'role' => 'required|in:'.implode(',', array_keys(Auth::user()->allowed_roles('update')))
        ]);

        if($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user->syncRoles($request->role);

        Flash::success(sprintf('You\'ve successfully changed the %s info.', $user->name));
        return ['errors' => false];
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->profile->delete();
        $user->syncRoles([]);
        $user->delete();

        Flash::success(sprintf('%s account has been deleted.', $user->name));
        return redirect()->route('admin.index');
    }
}
