<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Question;
use Illuminate\Http\Request;
use Auth;

class QuestionsContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
//        return $request->all();

//        $rules = [
//            'title' => 'required|min:6|max:196',
//            'body' => 'required|min:26',
//        ];
//
//        $message = [
//            'title.required' => '标题不能为空',
//            'title.min' => '标题不能少于6个字符',
//            'body.min' => '标题不能少于26个字符',
//            'body.required' => '内容不能为空',
//        ];
//
//        $this->validate($request,$rules,$message);

        //如果不使用上述的validate方法，可以使用下面的request注入的方式
        //将上述的那些rules messages写入到request里面
        //然后Request参数改成StoreQuestionRequest
        //这样子的目的可以使得Controller这里的代码更加简洁明了
        //php artisan make:request StoreQuestionRequest

        //那么，验证规则如何生效呢？
        //你所要做的就是在控制器方法中类型提示该请求。
        //表单输入请求会在控制器方法被调用之前被验证，
        //这就是说你不需要将控制器和验证逻辑杂糅在一起


        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id()
        ];

        $question = Question::create($data);
        return redirect()->route('questions.show',[$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        return view('questions.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}