<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use App\Notifications\MyFirstNotification;
use App\User;
use Auth;
class UserNotificationsController extends Controller
{
    public function show($id)
    {

        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
    
    return back();
}
}