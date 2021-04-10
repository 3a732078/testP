<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'contents' => 'required',
            'note_id'=>'required',
        ]);

        Comment::create([
            'user_id'=>$request->user()->id,
            'content'=>$request->contents,
            'note_id'=>$request->note_id,
            'time'=>now(),
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = array();
        $data['content'] = $request->content1;
        $update = DB::table('comments')->where('id', substr($request->zzz,7))->update($data);
        return Redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Comment::where('id', $id);
        $reply=Comment::where('replyId', $id);
        $delete->delete();
        $reply->delete();
        return back();
    }

    public function reply(Request $request)
    {
        if ($request->reply!=null){
                Comment::create([
                    'user_id'=>Auth::id(),
                    'content'=>$request->reply,
                    'note_id'=>$request->note_id,
                    'comment_id'=>$request->comment_id,
                    'time'=>now(),
                ]);
        }

        return back();
    }
}
