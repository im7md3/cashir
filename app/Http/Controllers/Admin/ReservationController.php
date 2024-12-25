<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupervisorRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ReservationController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('permission:read_admins')->only(['index']);
    //     $this->middleware('permission:create_admins')->only(['create', 'store']);
    //     $this->middleware('permission:update_admins')->only(['edit', 'update']);
    //     $this->middleware('permission:delete_admins')->only(['delete']);

    // }// end of __construct
    public function index()
    {
        return view('Reservation.reservations');
    }

}
