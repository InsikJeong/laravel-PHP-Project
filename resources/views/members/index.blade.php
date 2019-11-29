@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">   
    <div>
    <h1>멤버 소개</h1>
    <label class="btn btn-primary btnCreate" onclick="create()">멤버 추가</label>
    <div class="createDiv" id="createDiv">
        <hr />
        <form id="creForm" enctype="multipart/form-data">
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
                <input type="file" name="file" id="files" class="form-control" multiple/>
                {!!$errors->first('files.0', '<span class="form-error">:messaage</span>')!!}
            </div>
            <div class="form-group">
                <label class="btn btn-primary btnCre" onclick="btnCre()">
                    저장하기
                </label>
            </div>
        </form>
    </div>
    </div>
        @forelse ($members as $member)
            <div class="memberDiv">
                <div class="imgDiv">
                    <ul class="attachment__article">
                        <img src="http://127.0.0.1:8000/files/{{$member->filename}}" alt="11"
                        onclick="imgClick({{$member->id}})"></img>
                    </ul>
                </div>
                <div class="conDiv">
                    <div class="nameDiv" id="nameDiv{{$member->id}}">  {{$member->name}} </div>
                    <div class="commentsDiv" id="commentsDiv{{$member->id}}">{{$member->comments}}</div>
                </div>
                    <label class="btn btn-primary btnEdit" onclick="edit({{$member->id}})">정보 수정</label>
                    <label onclick="del('{{$member->id}}')">멤버 삭제</label>
            <div class="editDiv" id="editDiv{{$member->id}}">
                <form  id="editForm{{$member->id}}" action="{{route('members.update',$member->id)}}" method="POST">
                    <label for="name2">이름</label>
                    <input type="text" name="name2" id="name2" value="{{old('name2',$member->name)}}" class="..."/>
                    <hr>
                    <label for="comments2">한마디</label>
                    <textarea name="comments2" id="comments2" rows="10" class="form-control">{{old('comments2',$member->comments)}}</textarea>
                    <label class="btn btn-primary" onclick="btnEdit({{$member->id}})">수정하기</label>
                </form>
            </div>  
            </div>
        @empty
             <p>멤버가 없습니다.</p>
        @endforelse
@stop
@section('script')
    <script>
        var createCheck = 1; //create()함수 온오프 관리 
        var editCheck =1; //edit 함수 온오프 관리
        var check =1; // 조회 함수 온오프 관리

        function imgClick(id){
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type:"GET",
                url:'/members/'
            }).then(function(e){
                console.log("id"+id);
                if(check == 1){
                    console.log("이프"+check);
                    document.getElementById("nameDiv"+id).style.display="block";
                    document.getElementById("commentsDiv"+id).style.display="block";
                    check= 2;
                }
                else{
                    console.log("엘스"+check);
                    document.getElementById("nameDiv"+id).style.display="none";
                    document.getElementById("commentsDiv"+id).style.display="none";
                    check=1;
                }
            })
        };
        function del(id){
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            if(confirm('멤버를 삭제합니다.')){
                console.log("이프문");
                $.ajax({
                    type:"DELETE",
                    url: '/members/' +id
                }).then(function(e){
                    console.log("덴");
                    window.location.href='/members';
                },function(e){
                    console.log(e);
                });
            }
        };

        function btnCre(){
            var form =$('#creForm')[0];
            var data = new FormData(form);
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                console.log("이프문");
                $.ajax({
                    type:"post",
                    enctype:"multipart/form-data",
                    data: data,
                    url: "/members/store",
                    processData: false,
                    contentType: false,
                    cache:false,
                    success:function(data){
                        window.location.href='/members';
                    }
                    ,
                    error:function(data){
                        console.log(data);
                    alert("error");
                    }
                });
        }
        function btnEdit(id){
            var form  = $('#editForm'+id)[0];
            var data = new FormData(form);
            console.log(form);
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                    type:"POST",
                    url: '/members/' +id+'/update',
                    // data: $('#editForm').serialize(),
                    data: data,
                    processData:false,
                    contentType:false,
                    cache:false,
                }).then(function(data){
                    console.log("수정 성공");
                    // alert(data);
                    window.location.href='/members';
                },function(e){
                    console.log("수정실패");
                    console.log(e);
                });
        };


        function create(){
            console.log(createCheck);
            if(createCheck == 1){
                document.getElementById("createDiv").style.display="block";
                createCheck=0;
                }
            else if(createCheck == 0){
                console.log("작동");
                document.getElementById("createDiv").style.display="none";
                createCheck=1;
            }
            
        }

        function edit(id){
            if(editCheck == 1){
                document.getElementById("editDiv"+id).style.display="block";
                editCheck=0;
                }
            else if(editCheck == 0){
                document.getElementById("editDiv"+id).style.display="none";
                editCheck=1;
            }
        }
      
    </script>
@stop
@section('style')
        <style>
            .editDiv{
                display:none;
            }
            .createDiv{
                display:none;
            }
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
