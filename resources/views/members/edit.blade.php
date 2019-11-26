@extends('layouts.app')
@section('content')
    <div class="page-header">
        <h4>멤버<small> / 글 수정 /{{$member->id}}</small></h4>
    </div>

    <form action="{{route('members.update',$member->id)}}" method="POST">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <div class="...">
            <label for="name">이름</label>
            <input type="text" name="name" id="name" value="{{old('name',$member->name)}}" class="..."/>
            {!! $errors->first('name','<span class="form-error">:message</span>')!!}
        </div>

        <div class="form-group {{ $errors->has('comments') ? 'has-error' : ''}}">
            <label for="comments">한마디</label>
            <textarea name="comments" id="comments" rows="10" class="form-control">{{old('comments',$member->comments)}}</textarea>
            {!! $errors->first('comments','<span class="form-error">:message</span>')!!}
        </div>
        <div class="form-group"><button ...>수정하기</button></div>
    </form>
@stop