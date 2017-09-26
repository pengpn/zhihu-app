<?php

namespace App\Http\Controllers;

use App\Message;
use Auth;
use Illuminate\Http\Request;

class InboxController extends Controller
{

    /**
     * InboxController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');//用户一定要登录进来才可以访问下面的所有方法
    }

    public function index()
    {
        $messages = Auth::user()->messages->groupBy('from_user_id');
        return view('inbox.index',compact('messages'));
    }

    public function show($userId)
    {
        $messages = Message::where('from_user_id',$userId)->get();
        dd($messages);
    }
}
