<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/9/25
 * Time: 下午11:18
 */

if (! function_exists('user')) {
    /**
     * @param null $driver
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function user($driver = null) {
        if ($driver) {
            return app('auth')->guard($driver)->user();//不推荐直接使用Auth::guard('api')->user();这个Auth Facade
        }

        return app('auth')->user();
    }
}