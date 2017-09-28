<?php

namespace App\Http\Controllers;

use App\Notifications\NewMessageNotification;
use App\Repositories\MessageRepository;
use Auth;
use Illuminate\Http\Request;

/**
 * Class InboxController
 * @package App\Http\Controllers
 */
class InboxController extends Controller
{
    /**
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * InboxController constructor.
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->middleware('auth');//用户一定要登录进来才可以访问下面的所有方法
        $this->messageRepository = $messageRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $messages = $this->messageRepository->getAll();
        return view('inbox.index',['messages' => $messages->groupBy('dialog_id')]);
    }

    /**
     * @param $dialogId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($dialogId)
    {
        $messages = $this->messageRepository->getDialogMessagesByDialogId($dialogId);
        $messages->markAsRead();
        return view('inbox.show',compact('messages','dialogId'));
    }

    /**
     * @param Request $request
     * @param $dialogId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $dialogId)
    {
        $message = $this->messageRepository->getSingleMessageBy($dialogId);

        $toUserId = $message->from_user_id === user()->id ? $message->to_user_id : $message->from_user_id;

        $newMessage = $this->messageRepository->create([
            'from_user_id' => user()->id,
            'to_user_id' => $toUserId,
            'body' => $request->get('body'),
            'dialog_id' => $dialogId
        ]);

        //触发通知 这里希望接收私信用户看到消息提示，所以用 toUser
        $newMessage->toUser->notify(new NewMessageNotification($newMessage));

        return back();
    }
}
