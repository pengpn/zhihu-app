<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/9/15
 * Time: 下午10:45
 */

namespace App\Repositories;


use App\Answer;

class AnswerRepository
{
    public function create(array $attributes)
    {
        return Answer::create($attributes);
    }
}