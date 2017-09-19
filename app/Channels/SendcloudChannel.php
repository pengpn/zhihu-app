<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/9/19
 * Time: 下午9:42
 */

namespace App\Channels;


use Illuminate\Notifications\Notification;

class SendcloudChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSendcloud($notifiable);
    }
}