<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('users.setting');
    }

    public function store(Request $request)
    {
        //array_only 是 laravel的helper function
        //只取city bio的数据
        $settings = array_merge(user()->settings,array_only($request->all(),['city','bio']));

        user()->update(['settings' => $settings]);

        return back();
    }
}
