<?php

namespace App\Http\Controllers;

use App\Models\CourseStudent;
use App\Models\Note;
use App\Models\Textbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
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
        return view('notes.create');
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
//            'class' => 'required',
            'notename' => 'required',
            'json' => 'required',

        ]);
        $json = $request->json;
        Storage::disk('public')->put('\\json\\' . $request->class . '\\' . $request->notename . '.json', $json);
        $path = $request->notename . '.json';
        Note::create([
            'user_id'=>$request->user()->id,
            'title'=>$request->notename,
            'content'=>"XXXXXXX",
            'time'=>now(),
            'path'=>"??",
            'share'=>0,
            'like'=>0,
            'textfile'=>$path
        ]);
    }

    public function image(Request $request)
    {
        $this->validate($request, [
            'img' => 'required',
        ]);

        if($request->file('img')) {
            $filename = $request->file('img')->getClientOriginalName();

            $request->img->move(public_path() . '\images\\', $filename);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }

    public function search(Request $request)
    {
        //撈出該學生所有修的課程
        $courseId = CourseStudent::where('student_id',Auth::id())->get();
        $courseId = $courseId->toArray();
        $courseId = array_column($courseId,'course_id');

        //撈出對應課程id的教材編號
        $textBookId = Textbook::whereIn('course_id',$courseId)->get();
        $textBookId = $textBookId->toArray();
        $textBookId = array_column( $textBookId,'id');
        $search= $request->input('searchs');
        //撈出標題符合關鍵字的筆記，且教材編號等於使用的教材編號
        $searchs=Note::where("title", "like", '%' . $search . '%')
                    ->whereIn('textbook_id',$textBookId)
                    ->get();
        return view('notes.search',['searchs'=>$searchs]);

    }

    public function mynote(Request $request)
    {
        $notes=Note::where('user_id',Auth::id())->get();
        return view('notes.mynote',['notes'=>$notes]);
    }
}
