<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Hash;

/**
 * Class PasswordController
 * @package App\Http\Controllers
 */
class PasswordController extends Controller
{

    //展示表单
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function password()
    {
        return view('users.password');
    }

    //更新密码

    /**
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ChangePasswordRequest $request)
    {
        //Hash::check 背后就是用的 password_verify()
        if (Hash::check($request->get('old_password'),user()->password)) {
            user()->password = bcrypt($request->get('password'));
            user()->save();
            flash('密码修改成功','success');

            return back();
        }

        flash('密码修改失败','danger');
        return back();
    }
}
