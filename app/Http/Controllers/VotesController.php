<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use Auth;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    protected $answerRepository;

    /**
     * VotesController constructor.
     * @param $answerRepository
     */
    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function users($id)
    {
        $user = Auth::guard('api')->user();

        if ($user->hasVotedFor($id)) {
            return response()->json(['voted' => true]);
        }

        return response()->json(['voted' => false]);
    }

    public function vote(Request $request)
    {
        $answer = $this->answerRepository->byId($request->get('answer'));
        $voted = Auth::guard('api')->user()->voteFor($request->get('answer'));

        if (count($voted['attached']) > 0 ) {
            $answer->increment('votes_count');
            return response()->json(['voted' => true]);
        }

        $answer->decrement('votes_count');
        return response()->json(['voted' => false]);
    }
}
