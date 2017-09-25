<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/9/25
 * Time: 下午10:49
 */

namespace App\Repositories;


use App\Answer;
use App\Comment;

class CommentRepository
{
    public function create(array $attributes)
    {
        return Comment::create($attributes);
    }


}