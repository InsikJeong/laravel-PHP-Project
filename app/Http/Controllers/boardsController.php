<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class boardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = \App\Board::with('user')->latest()->paginate(5);
        return view('boards.index',compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $board = new \App\Board;

        return view('boards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\BoardsRequest $request)
    {   
        // $board = \App\User::find(1)->boards()->create($request->all());
        $board = $request->user()->boards()->create($request->all());

        if(! $board){
            return back()->with('flash_message','글이 저장되지 않았습니다.')->withInput();
        }

        return redirect(route('boards.index'))->with('flash_message','작성하신 글이 저장되었습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Board $board)
    {
        // $board = \App\Board::findOrFail($id);

        print('여기는 쇼 입니다.');
        return view('boards.show',compact('board'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Board $board)
    {
        return view('boards.edit',compact('board'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\BoardsRequest $request, \App\Board $board)
    {
        $board->update($request->all());
        // flash()->success('수정내용 저장');

        return redirect(route('boards.show',$board->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Board $board)
    {
        print("haha");
        // $board = \App\Board::Class;
        // $idd = $board->find($id);
        $board->delete();
    
        return response()->json([],204);
    }
}
