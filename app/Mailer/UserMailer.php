<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/9/20
 * Time: 下午9:21
 */

namespace App\Mailer;

use App\User;
use Auth;


class UserMailer extends Mailer
{
    public function followNotifyEmail($email)
    {
        $data = [
            'url' => 'http://zhihu.app',
            'name' => Auth::guard('api')->user()->name
        ];
        
        $this->sendTo('zhihu_app_new_user_follow', $email, $data);
        
    }

    public function passwordReset($email, $token)
    {
        $data = ['url' => url('password/reset',$token)];

        $this->sendTo('zhihu_reset_password',$email,$data);
    }

    public function welcome(User $user)
    {
        // 模板变量
        $data = [
            'url' => route('email.verify',['token' => $user->confirmation_token]),
            'name' => $user->name
        ];

        $this->sendTo('zhihu_app_register',$user->email,$data);
    }
}