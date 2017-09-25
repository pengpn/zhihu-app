<?php

namespace App\Http\Controllers;

use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    protected $topicRepository;

    /**
     * TopicsController constructor.
     * @param $topicRepository
     */
    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    public function index(Request $request)
    {
        return $this->topicRepository->getTopicsForTagging($request);
    }
}
