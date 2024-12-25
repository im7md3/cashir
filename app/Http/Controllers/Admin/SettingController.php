<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupervisorRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_settings')->only(['index']);
        $this->middleware('permission:create_settings')->only(['create', 'store']);
        $this->middleware('permission:update_settings')->only(['edit', 'update']);
        $this->middleware('permission:delete_settings')->only(['delete']);

    }// end of __construct
    public function index()
    {
        return view('settings');
    }

}
