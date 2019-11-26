<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $attachments = \App\Attachment::get();
        $members = \App\Members::get();
        return view('members.index',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = new \App\Members;
        // $attachment = new \App\Attachment;

        return view('members.create',compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\MembersRequest $request)
    {
        
        $members = \App\Members::create($request->all());

        if($request->hasFile('files')){
            $files= $request->file('files');

            if ($request->hasFile('files')) {
                // 파일 저장
                $files = $request->file('files');
     
                foreach($files as $file) {
                    $filename = Str::random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
     
                    // 순서 중요 !!!
                    // 파일이 PHP의 임시 저장소에 있을 때만 getSize, getClientMimeType등이 동작하므로,
                    // 우리 프로젝트의 파일 저장소로 업로드를 옮기기 전에 필요한 값을 취해야 함.
                    $members->attachments()->create([
                        'filename' => $filename,
                        'bytes' => $file->getSize(),
                        'mime' => $file->getClientMimeType()
                    ]);
     
                    $file->move(attachments_path(), $filename);
                }
            }

        }
        return redirect(route('members.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Members $member)
    {
        print("여기는 쇼");
        return view("members.show",compact("member"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Members $member)
    {
        return view('members.edit',compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\MembersRequest $request, \App\Members $member)
    {
        $member->update($request->all());
        // return redirect(route('members.index'));
        return redirect(route('members.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Members $member)
    {
        // print("haha");
        // $board = \App\Board::Class;
        // $idd = $board->find($id);
        $member->delete();
    
        return response()->json([],204);
    }
}
