@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>멤버 추가</h1>
        <hr />
        <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!} {{-- @csrf --}}
            {{-- route()-url경로, csrf_field(): csrf 대응 헬퍼함수 --}}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">이름</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"/>
                {!! $errors->first('name','<span class="form-error">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('comments') ? 'has-error' : ''}}">
                <label for="comments">한마디</label>
                <textarea name="comments" id="comments" rows="10" class="form-control">{{ old('comments')}}</textarea>
                {!! $errors->first('comments','<span class="form-error">:message</span>') !!}
            </div>
            <div class="form-group {{$errors->has('files') ? 'has-error' :'' }}">
                <label for="files">파일</label>
                <input type="file" name="files[]" id="files" class="form-control" multiple/>
                {!!$errors->first('files.0', '<span class="form-error">:messaage</span>')!!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    저장하기
                </button>
            </div>
        </form>
    </div>
@stop