<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $data['title'] = 'Single Chat';
        $data['user'] = \App\User::find(\Auth::id());
        return view('front_site.single-chat.chat', $data);
    }
}
