<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // دالة لحذف جميع الإشعارات
    public function deleteAll()
    {
        // حذف جميع الإشعارات للمستخدم الحالي
        Auth::user()->notifications()->delete();
        
        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'تم حذف جميع الإشعارات بنجاح');
    }
}
