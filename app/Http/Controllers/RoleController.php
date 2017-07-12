<?php

namespace App\Http\Controllers;

use App\Models\Mode;
use App\Models\ModeRole;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Flash;
use Validator;
use Log;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read-module-roles')->only('index');
        $this->middleware('permission:create-module-roles')->only(['create', 'store']);
        $this->middleware('permission:update-module-roles')->only(['edit', 'update']);
        $this->middleware('permission:delete-module-roles')->only('destroy');
    }

    public function index(Request $request)
    {
        $roles = Role::where(function($q) use ($request) {
            $q->whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($request->search).'%']);
            $q->orWhereRaw('LOWER(display_name) LIKE ?', ['%'.strtolower($request->search).'%']);
            $q->orWhereRaw('LOWER(description) LIKE ?', ['%'.strtolower($request->search).'%']);
        })
        ->paginate(20);

        return view('role.index', compact('roles'));
    }

    public function create()
    {
        $role = new Role();
        $permissions = Permission::pluck('display_name', 'id');
        $permission = null;
        $modes = Mode::pluck('display_name', 'id');
        $mode = null;

        return view('role.form', compact('role', 'permissions', 'permission', 'modes', 'mode'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'display_name' => 'required|unique:roles|max:255',
            'description' => "required|max:255",
            'permission' => "required",
            'mode' => 'required'
        ]);

        if($validate->fails()) {
            return ['errors' => $validate->errors()];
        }

        $role = new Role();
        $role->name = str_slug($request->display_name);
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        $role->attachPermissions($request->permission);

        $mode = new ModeRole();
        $mode->mode_id = $request->mode;
        $mode->role_id = $role->id;
        $mode->save();

        foreach (['create', 'read', 'update', 'delete'] as $ability) {
            $permission = new Permission();
            $permission->name = sprintf('%s-role-admin-%s', $ability, $role->name);
            $permission->display_name = sprintf('%s Role-admin-%s', ucfirst($ability), $role->name);
            $permission->description = sprintf('%s Role-admin-%s', ucfirst($ability), $role->name);
            $permission->save();
        }

        Flash::success(sprintf('You\'ve successfully created the %s role.', $role->display_name));
        return ['errors' => false];
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::pluck('display_name', 'id');
        $permission = $role->permissions->pluck('id')->toArray();
        $modes = Mode::pluck('display_name', 'id');
        $mode = $role->mode_role->mode->id;

        return view('role.form', compact('role', 'permissions', 'permission', 'modes', 'mode'));
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'display_name' => "required|unique:roles,display_name,$id,id|max:255",
            'description' => "required|max:255",
            'permission.*' => "required"
        ]);

        if($validate->fails()) {
            return ['errors' => $validate->errors()];
        }

        $role = Role::find($id);
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        $role->syncPermissions($request->permission);

        Log::error($role->mode_role);
        $mode = $role->mode_role;
        $mode->mode_id = $request->mode;
        $mode->role_id = $role->id;
        $mode->save();

        Flash::success(sprintf('You\'ve successfully edited the %s role.', $role->display_name));
        return ['errors' => false];
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if($role->role_user) {
            Flash::error(sprintf('Role %s cannot be deleted, it\'s already used.', $role->display_name));
            return redirect()->route('role.index');
        }
        $role->syncPermissions([]);
        $role->delete();

        Permission::where("name", "LIKE", "%-role-%-$role->name")
            ->delete();

        Flash::success(sprintf('%s role has been deleted.', $role->display_name));
        return redirect()->route('role.index');
    }
}
