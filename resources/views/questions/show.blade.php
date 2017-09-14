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
                    <div class="panel-body">
                        {!! $question->body !!}
                    </div>

                    <div class="action">
                        @if(Auth::check() && Auth::user()->owns($question))
                            <span class="edit"><a href="{{ route('questions.edit',$question->id) }}">编辑</a></span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
