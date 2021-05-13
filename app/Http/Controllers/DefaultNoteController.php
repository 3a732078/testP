<?php

namespace App\Http\Controllers;

use App\Models\DefaultNote;
use App\Models\Note;
use Illuminate\Http\Request;

class DefaultNoteController extends Controller
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

        $hasNote=DefaultNote::where('id',$request->id)->get();
//        $setDefault=User::find(Auth::id())->defnotes()->get();
        $classname=Note::find($request->id)->textbook->name;
        $quantity=DefaultNote::where('user_id',$request->user()->id)->where('classname',$classname)->get();
        $content=DefaultNote::where('user_id',$request->user()->id)->where('classname',$classname);

        $this->validate($request, [
            'id' => 'required',
        ]);

        if($request->has('dfnote')){
            $request->dfnote=1;

            if (count($quantity)<1){
                DefaultNote::create([
                    'user_id'=>$request->user()->id,
                    'note_id'=>$request->id,
                    'classname'=>$classname
                ]);
            }elseif (count($quantity)>=1){
                $content->update([
                    'note_id' => $request->id,
                ]);
            }

        }else {
            $request->dfnote = 0;

            $delete = DefaultNote::where('note_id', $request->id)->where('user_id', $request->user()->id);
            $delete->delete();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DefaultNote  $defaultNote
     * @return \Illuminate\Http\Response
     */
    public function show(DefaultNote $defaultNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DefaultNote  $defaultNote
     * @return \Illuminate\Http\Response
     */
    public function edit(DefaultNote $defaultNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DefaultNote  $defaultNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DefaultNote $defaultNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DefaultNote  $defaultNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(DefaultNote $defaultNote)
    {
        //
    }
}
