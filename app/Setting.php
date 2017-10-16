<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/10/16
 * Time: 下午9:42
 */

namespace App;


class Setting
{
    protected $allowed = ['city','bio'];

    protected $user;

    /**
     * Setting constructor.
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function merge(array $attributes)
    {
        //array_only 是 laravel的helper function
        //只取city bio的数据
        $settings = array_merge($this->user->settings,array_only($attributes,$this->allowed));
        $this->user->update(['settings' => $settings]);
    }
}