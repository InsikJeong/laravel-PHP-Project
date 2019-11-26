@extends('layouts.app')
@section('content')
    <div class="page-header">
        <h4>포럼<small> / 글 수정 /{{$board->title}}</small></h4>
    </div>

    <form action="{{route('boards.update',$board->id)}}" method="POST">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <div class="...">
            <label for="title">제목</label>
            <input type="text" name="title" id="title" value="{{old('title',$board->title)}}" class="..."/>
            {!! $errors->first('title','<span class="form-error">:message</span>')!!}
        </div>

        <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
            <label for="content">본문</label>
            <textarea name="content" id="content" rows="10" class="form-control">{{old('content',$board->content)}}</textarea>
            {!! $errors->first('content','<span class="form-error">:message</span>')!!}
        </div>
        <div class="form-group"><button ...>수정하기</button></div>
    </form>
@stop