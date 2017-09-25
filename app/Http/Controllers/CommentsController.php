<?php

namespace App\Http\Controllers;


use App\Repositories\AnswerRepository;
use App\Repositories\CommentRepository;
use App\Repositories\QuestionRepository;
use Auth;
use Illuminate\Http\Request;

/**
 * Class CommentsController
 * @package App\Http\Controllers
 */
class CommentsController extends Controller
{
    /**
     * @var AnswerRepository
     */
    protected $answerRepository;
    /**
     * @var QuestionRepository
     */
    protected $questionRepository;
    /**
     * @var CommentRepository
     */
    protected $commentRepository;

    /**
     * CommentsController constructor.
     * @param $answerRepository
     * @param $questionRepository
     * @param $commentRepository
     */
    public function __construct(AnswerRepository $answerRepository,QuestionRepository $questionRepository,CommentRepository $commentRepository)
    {
        $this->answerRepository = $answerRepository;
        $this->questionRepository = $questionRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function answer($id)
    {
        return $this->answerRepository->getAnswerCommentById($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function question($id)
    {
        return $this->questionRepository->getQuestionCommentsById($id);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request)
    {
        $model = $this->getModelNameFromType($request->get('type'));

        return $this->commentRepository->create([
           'commentable_id' => $request->get('model'),
           'commentable_type' => $model,
           'user_id' => user('api')->id,
            'body' => $request->get('body')
        ]);
    }

    /**
     * @param $type
     * @return string
     */
    public function getModelNameFromType($type)
    {
        return $type === 'question' ? 'App\Question' : 'App\Answer';
    }
}
