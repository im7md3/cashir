<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupervisorRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BranchController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_branches')->only(['index']);
        $this->middleware('permission:create_branches')->only(['create', 'store']);
        $this->middleware('permission:update_branches')->only(['edit', 'update']);
        $this->middleware('permission:delete_branches')->only(['delete']);

    }// end of __construct
    public function index()
    {
        return view('branch.index');
    }

}
