<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/9/20
 * Time: 下午8:52
 */

namespace App\Mailer;

use Mail;
use Naux\Mail\SendCloudTemplate;

class Mailer
{
    protected function sendTo($template, $email, array $data)
    {
        $content = new SendCloudTemplate($template, $data);

        Mail::raw($content, function ($message) use ($email) {
            $message->from('us@pengpn.me', 'pengpn');
            $message->to($email);
        });
    }
}