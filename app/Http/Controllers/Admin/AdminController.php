<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupervisorRequest;
use App\Models\Branch;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_admins')->only(['index']);
        $this->middleware('permission:create_admins')->only(['create', 'store']);
        $this->middleware('permission:update_admins')->only(['edit', 'update']);
        $this->middleware('permission:delete_admins')->only(['delete']);
    } // end of __construct
    public function index()
    {
        // $users = User::whereRoleIs(['admin','user'])->with('roles','category')->latest()->paginate(10);
        $users = User::with('roles', 'category')->when(request('branch_id'), function ($q) {
            $q->where('branch_id', request('branch_id'));
        })->latest()->paginate(10);
        return view('users.index', compact('users'));
    }
    public function create()
    {
        // $roles=Role::whereNotIn('name', ['super_admin', 'admin'])->get();
        $roles = Role::get();
        $branches = Branch::get();
        // $roles=Role::get();
        $payment_methods = PaymentMethod::where('is_cash', 1)->get();
        return view('users.create', compact('roles', 'payment_methods', 'branches'));
    }
    public function store(SupervisorRequest $request)
    {
        try {
            $input['name'] = $request->name;
            $input['email'] = $request->email;
            $input['email_verified_at'] = now();
            $input['password'] = bcrypt($request->password);
            $input['phone'] = $request->phone;
            $input['user_category_id'] = $request->user_category_id;
            $input['payment_method_id'] = $request->payment_method_id;
            $input['branch_id'] = $request->branch_id;
            $admin = User::create($input);
            // $admin->attachRoles(['admin', $request->role_id]);
            $admin->attachRoles([$request->role_id]);
            Alert::success('تمت الاضافه بنجاح');
            return redirect()->route('admins.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(User $admin)
    {
        // $roles=Role::whereNotIn('name', ['super_admin', 'admin'])->get();
        $roles = Role::get();
        $branches = Branch::get();
        $payment_methods = PaymentMethod::where('is_cash', 1)->get();
        return view('users.edit', compact('admin', 'roles', 'payment_methods', 'branches'));
    }
    public function update(SupervisorRequest $request, User $admin)
    {
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        if (trim($request->password) != '') {
            $input['password'] = bcrypt($request->password);
        }
        $input['phone'] = $request->phone;
        $input['user_category_id'] = $request->user_category_id;
        $input['payment_method_id'] = $request->payment_method_id;
        $input['branch_id'] = $request->branch_id;
        $admin->update($input);
        $admin->syncRoles([$request->role_id]);
        Alert::success('تمت التعديل بنجاح');
        return redirect()->route('admins.index');
    }

    public function destroy(User $admin)
    {
        $admin->delete();
        Alert::success('تمت الحذف بنجاح');
        return redirect()->back();
    }
}
