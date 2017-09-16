@extends('layouts.app')

@section('content')

    @include('vendor.ueditor.assets')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $question->title }}
                        @foreach($question->topics as $topic)
                            <a href="#" class="topic"><span class="topic">{{ $topic->name }}</span></a>
                        @endforeach
                    </div>
                    <div class="panel-body content">
                        {!! $question->body !!}
                    </div>

                    <div class="action">
                        @if(Auth::check() && Auth::user()->owns($question))
                            <span class="edit"><a href="{{ route('questions.edit',$question->id) }}">编辑</a></span>
                            <form action="{{ route('questions.destroy',$question->id) }}" method="post" class="delete-form">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="button is_naked delete-button">删除</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $question->answers_count }} 个答案
                    </div>
                    <div class="panel-body">

                        @foreach($question->answers as $answer)
                            <div class="media">
                                <div class="media-left">
                                    <a href="">
                                        <img width="36" src="{{ $answer->user->avatar }}"
                                             alt="{{ $answer->user->avatar }}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/user/{{  $answer->user->name }}">
                                            {{ $answer->user->name }}
                                        </a>
                                    </h4>
                                    {!! $answer->body !!}
                                </div>
                            </div>
                        @endforeach

                        @if(Auth::check())
                        <form action="{{ route('answers.store',$question->id) }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <!-- 编辑器容器 -->
                                <script id="container" name="body" type="text/plain">
                                    {!! old('body') !!}
                                </script>
                                @if($errors->has('body'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                                @endif
                            </div>

                            <button class="btn btn-success pull-right" type="submit">提交答案</button>
                        </form>
                        @else
                                <a href="{{ url('login') }}" class="btn btn-success btn-block">登录提交答案</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });

            $(document).ready(function() {
                function formatTopic (topic) {

                    return "<div class='select2-result-repository clearfix'>" +

                    "<div class='select2-result-repository__meta'>" +

                    "<div class='select2-result-repository__title'>" +

                    topic.name ? topic.name : "Laravel"   +

                        "</div></div></div>";

                }


                function formatTopicSelection (topic) {

                    return topic.name || topic.text;

                }


                $(".js-example-data-ajax").select2({

                    tags: true,

                    placeholder: '选择相关话题',

                    minimumInputLength: 2,

                    ajax: {

                        url: '/api/topics',

                        dataType: 'json',

                        delay: 250,

                        data: function (params) {

                            return {

                                'topic-name' : params.term

                            };

                        },

                        processResults: function (data, params) {

                            return {

                                results: data

                            };

                        },

                        cache: true

                    },

                    templateResult: formatTopic,

                    templateSelection: formatTopicSelection,

                    escapeMarkup: function (markup) { return markup; }

                });
            });
        </script>
    @endsection

@endsection
