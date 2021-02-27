<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
       if ($request->ajax()) {
       }
       return view('backend.notification.index');
    }

    public function makeread(Request $request)
    {

    }

    public function delete($id)
    {

    }
}
