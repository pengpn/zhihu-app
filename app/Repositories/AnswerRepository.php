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
    public function byId($id)
    {
        return Answer::find($id);
    }

    public function create(array $attributes)
    {
        return Answer::create($attributes);
    }

    public function getAnswerCommentById($id)
    {
        $answer = Answer::with('comments','comments.user')->where('id',$id)->first();
        return $answer->comments;
    }
}