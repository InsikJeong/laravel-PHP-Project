@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>글 목록</h1>
        <hr/>
        <ul>
            @forelse($boards as $board)
                <li>
                       <a href="{{route('boards.show',$board->id)}}">
                     {{$board->title}}
                     </a>
                    <small>
                        by {{ $board->user->name }}
                    </small>
                </li>
            @empty
                <p>글이 없습니다.</p>
            @endforelse
        </ul>
    </div>
@if($boards->count())
    <div class="text-center">
    {!! $boards->render() !!} {{-- XSS 보호기능 끄기: htmlspecialchars 안하기 --}}
    </div>
@endif
    <div class="text-right">
        <a href="{{route('boards.create')}}" class="btn btn-primary">
            <i class="fa fa-plus-circle"></i> 새글쓰기
        </a>
    </div>
@stop