@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h4>포럼<small> /{{$board->title}}</small></h4>
    </div>

    <article data-id="{{$board->id}}">
        <p>{!! $board->content !!}</p>
    </article>
    
    <div class="text-center action__article">
        <a href="{{route('boards.edit',$board->id)}}" class="btn btn-info">
         글 수정
        </a>
        <button class="btn btn-danger button_delete" id="is">
        글 삭제
        </button>
        <a href="{{route('boards.index')}}" class="btn btn-default">
         글 목록
        </a>
    </div>

@stop

@section('script')
    <script>
        // <meta name="csrf-token" content="{{ csrf_token() }}">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        console.log("성공했다");
        // console.log({{ csrf_token() }});
        console.log("성공했다");
        $('.button_delete').on('click',function(e){
            console.log("요청도 성공했다");
            // var boardId = $('board').data('id');
            var boardId = '{{$board->id}}';
            console.log(boardId);
            if(confirm('글을 삭제합니다.')){
                console.log("이프문");
                $.ajax({
                    type:"DELETE",
                    // method: "DELETE",
                    url: '/boards/' +boardId
                }).then(function(e){
                    console.log("덴");
                    window.location.href='/boards';
                },function(e){
                    console.log("실패");
                    console.log(e);
                });
            }
        }, );
    </script>
@stop