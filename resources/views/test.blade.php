@extends('layouts.app')

@section('content')
    <label onclick="test()">ddddddddddddddd</label>
    <p></p>
@stop

@section('script')
    <script>
    function test(){ 
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
$.ajax({  
  type: "POST" 
 ,url: "/test/aa"
 ,data: {aaa:"1",bbb:'2'}
 ,success:function(data){
   alert(data);
 }
 ,error:function(data){
   alert("error");
 }
 });
}
    </script>
@stop