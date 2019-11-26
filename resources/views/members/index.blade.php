@extends('layouts.app')

@section('content')
    <div>
    <h1>멤버 소개</h1>
    <a href="{{route('members.create')}}" class="btn btn-primary">멤버 추가</a>
    </div>
        @forelse ($members as $member)
            <div class="memberDiv">
                <div class="imgDiv">
                    @include('members.list',['attachments'=>$member->attachments])
                </div>
                <div class="conDiv">
                    <div class="nameDiv" id="nameDiv{{$member->id}}">  {{$member->name}} </div>
                    <div class="commentsDiv" id="commentsDiv{{$member->id}}">{{$member->comments}}</div>
                </div>
                    <a href="{{route('members.edit',$member->id)}}" class="btn btn-info"> 정보 수정</a>
                    <label onclick="del('{{$member->id}}')">멤버 삭제</label>
            </div>
        @empty
             <p>멤버가 없습니다.</p>
        @endforelse
@stop
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('comments')
            }
        }); 

        function del(id){
            if(confirm('멤버를 삭제합니다.')){
                console.log("이프문");
                $.ajax({
                    type:"DELETE",
                    url: '/members/' +id
                }).then(function(e){
                    console.log("덴");
                    window.location.href='/members';
                },function(e){
                    console.log("실패");
                    console.log(e);
                });
            }
        };
      
    </script>
@stop
@section('style')
        <style>
            .memberDiv{
                /* display : flex;
                flex-wrap:wrap;
                justify-content: center;
                margin: 50px; */
                display:inline-block;
            }

            .nameDiv,.commentsDiv{
                display : none;
                margin-left:70px;
                width:230px;

            }

            .btn-info{
                margin-left:70px;
            }
            img{
                width:230px;
                height:300px;
            }
        </style>
@stop
