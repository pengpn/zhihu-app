<?php

namespace App\Http\Controllers;

use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Auth;

class MessagesController extends Controller
{
    protected $messageRepository;

    /**
     * MessagesController constructor.
     * @param $messageRepository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function store(Request $request)
    {
        $message = $this->messageRepository->create([
            'to_user_id' => $request->get('user'),
            'from_user_id' => Auth::guard('api')->user()->id,
            'body' => $request->get('body')
        ]);

        if ($message) {
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);

    }
}
