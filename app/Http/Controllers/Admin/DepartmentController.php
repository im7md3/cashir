<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupervisorRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DepartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_departments')->only(['index']);
        $this->middleware('permission:create_departments')->only(['create', 'store']);
        $this->middleware('permission:update_departments')->only(['edit', 'update']);
        $this->middleware('permission:delete_departments')->only(['delete']);

    }// end of __construct
    public function index()
    {
        return view('department.index');
    }

}
