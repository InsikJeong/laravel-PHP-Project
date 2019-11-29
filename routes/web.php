<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::resource('boards','boardsController');

Route::resource('members','MembersController');
Route::post('members/{id}/update/','MembersController@update');
// Route::GET('members/create','MembersController@create');
Route::post('members/store','MembersController@store');
// // Route::get('members/update/{id}',[
//     'as'=> 'members.update',
//     'uses'=> 'MembersController@update'
// ]);

Route::get('/test',function(){
    return view('test');
});

Route::post('/test/aa',function(){
    return view('test');
});
// Route::get('auth/login',function(){
//     $credentials = [ // 로그인 기능 : 입력구현 하는 걸 권장
//         'email'=>'jis@naver.com',
//         'password'=>'password',
//     ];
//     //Auth 파사드와 같은 기능 
//     if(! auth()->attempt($credentials)){
//         //auth()->attempt($credentials)
//         //인증 시도: 로그인 시도 ($credentials 값을 이용)
//         //return : true: 로그인성공 false : 로그인 실패 
//         return '로그인 정보가 정확하지 않습니다.';
//     }
//     //로그인 성공시 
//     return redirect('protected');
// });

// Route::get('protected',['middleware' => 'auth',function(){
//     dump(session()->all()); //세션의 모든정보를 화면에 덤프함
//     return auth()->user()->name.' 님 안녕하세요';
// }]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// DB::listen(function ($query){
//     var_dump($query->sql);
// });

// Route::resource('attachments','AttachmentsController',['only'=>'store','destroy']);