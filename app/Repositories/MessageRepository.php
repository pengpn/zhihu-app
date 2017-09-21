<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/9/21
 * Time: 下午9:24
 */

namespace App\Repositories;


use App\Message;

class MessageRepository
{


    public function create(array $attributes)
    {
        return Message::create($attributes);
    }


}