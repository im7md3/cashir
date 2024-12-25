<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getToken(Request $request)
    {
        $request->validate(['fcm_token' => 'required', 'user_id' => 'required']);
        $user = User::find($request->user_id);
        if ($user) {
            $user->update(['fcm_token' => $request->fcm_token]);
            return response()->json(['status' => '200', 'message' => 'OK', 'data' => $user]);
        } else {
            return response()->json(['status' => '200', 'message' => 'Can not find User Id']);
        }
    }
}
