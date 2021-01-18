<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotifyController extends Controller
{
    public function readAll()
    {
        $user = Auth::user();

        foreach($user->notifications as $notify){
            $notify->markAsRead();
        }

        return json_encode($user->unreadNotifications);

    }
}
