<?php

namespace App\Http\Controllers;

use App\Models\CollectNote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favor=User::find(Auth::id())->collects()->get();
        return view('notes.storehose',['favor'=>$favor]);
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
            'id' => 'required',
        ]);
//dd($request->heart);
        if($request->has('heart')){
            $request->heart=1;

            CollectNote::create([
                'user_id'=>$request->user()->id,
                'note_id'=>$request->id,
            ]);
        }else{
            $request->heart=0;

            $delete = CollectNote::where('note_id', $request->id)->where('user_id',$request->user()->id);
            $delete->delete();

        }

        return redirect('notes/classes/'.$request->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CollectNote  $collectNote
     * @return \Illuminate\Http\Response
     */
    public function show(CollectNote $collectNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CollectNote  $collectNote
     * @return \Illuminate\Http\Response
     */
    public function edit(CollectNote $collectNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CollectNote  $collectNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CollectNote $collectNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CollectNote  $collectNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(CollectNote $collectNote)
    {
        //
    }
}
