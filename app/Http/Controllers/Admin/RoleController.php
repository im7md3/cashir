<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\SupervisorRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_roles')->only(['index']);
        $this->middleware('permission:create_roles')->only(['create', 'store']);
        $this->middleware('permission:update_roles')->only(['edit', 'update']);
        $this->middleware('permission:delete_roles')->only(['delete']);
    } // end of __construct
    public function index()
    {
        // $roles=Role::whereNotIn('name',['super_admin','admin'])->withCount(['users'])->latest()->paginate(10);
        $roles = Role::withCount(['users'])->latest()->paginate(10);
        return view('roles.index', compact('roles'));
    }
    public function create()
    {
        $models = config('laratrust_seeder.roles_structure.super_admin');
        $permissionMaps = config('laratrust_seeder.permissions_map');
        return view('roles.create', compact('models', 'permissionMaps'));
    }
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->only(['name']));
        $role->attachPermissions($request->permissions);
        Alert::success('تمت الاضافه بنجاح');
        return redirect()->route('roles.index');
    }
    public function edit(Role $role)
    {
        $models = config('laratrust_seeder.roles_structure.super_admin');
        $permissionMaps = config('laratrust_seeder.permissions_map');
        return view('roles.edit', compact('role', 'models', 'permissionMaps'));
    }
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->only(['name']));
        $role->syncPermissions($request->permissions);
        Alert::success('تم التعديل بنجاح');
        return redirect()->route('roles.index');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        Alert::success('تم الحذف بنجاح');
        return redirect()->back();
    }
}
