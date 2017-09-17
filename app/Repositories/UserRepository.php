<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/9/17
 * Time: 上午10:19
 */

namespace App\Repositories;


use App\User;

class UserRepository
{
    public function byId($id)
    {
        return User::find($id);
    }
}