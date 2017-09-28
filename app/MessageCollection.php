<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/9/28
 * Time: 下午7:49
 */

namespace App;


use Illuminate\Database\Eloquent\Collection;

class MessageCollection extends Collection
{
    public function markAsRead()
    {
        $this->each(function($message){
            if($message->to_user_id === user()->id){
                $message->markAsRead();
            }
        });
    }
}