<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/9/25
 * Time: 下午11:11
 */

namespace App\Repositories;


use App\Topic;
use Illuminate\Http\Request;

class TopicRepository
{
    public function getTopicsForTagging(Request $request)
    {
        $topics = Topic::select(['id','name'])
            ->where('name','like','%'. $request->get('topic-name') .'%')
            ->get();
        return $topics;
    }
}