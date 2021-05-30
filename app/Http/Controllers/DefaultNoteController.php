<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\DefaultNote;
use App\Models\Note;
use App\Models\Textbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function show($id)
    {
        session_start();
        $class=$_SESSION['classId'];
        $ta=$_SESSION['ta'];
        $deftextbookId=$_SESSION['textbookId'];//textbookId
        $deftextbook=Textbook::find($deftextbookId);

        //筆記相關
        $jsonname=Note::where('id',$id)->value('textfile');
        $notename = str_replace(".json","",$jsonname);
        $file = Storage::disk('public')->get('\\json\\' . $jsonname);
        $author=Note::find($id)->user->name;

        $course=null;
        $classId=null;
        $textbook=null;
        $images=array();
        $textbookId=Note::where('id',$id)->value('textbook_id');//教材Id
        if ($textbookId!==null){
            $course=Textbook::find($textbookId)->course->name;//課程名稱
            $classId=Course::where('name',$course)->value('id');//課程Id
            $textbook=Textbook::find($textbookId);

            //讀取教材
            $name = $textbook->name;
            $files=scandir("./images/" . "$name");

            $imgArr = array();
            $images = array();
            for ($i=0;$i<count($files);$i++){

                if($files[$i]=='.'||$files[$i]=='..'){
                    continue;
                }
                $arr = explode('.',$files[$i]);
                $arr = $arr[1];
                $imgArr[] = $files[$i];
            }
            $num = 1;
            foreach ($imgArr as $r)
            {
                $images[] = "{$name}{$num}.{$arr}";
                $num++;
            }

        }else{
            $images=Note::where('id',$id)->value('page');
        }

        return view('textbooks.defshow',['id'=>$id,'class'=>$class,'ta'=>$ta,'deftextbook'=>$deftextbook,'author'=>$author,
            'name'=>$notename,'courses'=>$course,'classId'=>$classId,'textbook'=>$textbook,'images'=>$images,'json'=>$file,'textbookId'=>$textbookId]);
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
