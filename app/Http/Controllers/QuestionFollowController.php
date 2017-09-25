<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Auth;
class QuestionFollowController extends Controller
{
    protected $questionRepository;
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->middleware('auth');
        $this->questionRepository = $questionRepository;
    }

    public function follow($question)
    {
        Auth::user()->followThis($question);
        return back();
    }

    public function follower(Request $request)
    {
        $user = user('api');//使用自己的帮助类helpers.php
        $followed = $user->followed($request->get('question'));
        if ($followed) {
            return response()->json(['followed' => true]);
        }
        return response()->json(['followed' => false]);
    }

    public function followThisQuestion(Request $request)
    {
        $user = user('api');
        $question = $this->questionRepository->byId($request->get('question'));
        $followed = $user->followThis($question->id);
        //如果已经follow
        if (count($followed['detached']) > 0) {
            $question->decrement('followers_count');
            return response()->json(['followed' => false]);
        }

        //如果没有follow
        $question->increment('followers_count');
        return response()->json(['followed' => true]);
    }
}
