<?php

namespace App\Http\Controllers;

use App\Models\CollectNote;
use App\Models\Comment;
use App\Models\CourseStudent;
use App\Models\Note;
use App\Models\NoteScore;
use App\Models\Student;
use App\Models\Textbook;
use App\Models\User;
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
    public function show($id,Request $request)
    {

        $jsonname = Note::where('id', $id)->value('textfile');
        $id = Note::where('id', $id)->value('id');
        $share=Note::where('id',$id)->value('share');
        if($share){
            $share=1;
        }else{
            $share=0;
        }
        $user_id = Note::where('id', $id)->value('user_id');
        $login = User::where('id', $request->user()->id)->value('id');
        if ($id && $user_id === $login) {
            $notename = str_replace(".json", "", $jsonname);

//        $notes=Note::where('class',$class)->paginate(1);//分頁測試

            $file = Storage::disk('public')->get('\\json\\' . $jsonname);


            //這個是抓留言資料
//            $comment=Comment::where('note_id',$id)->value('content');
            return view('notes.show', ['id' => $id, 'json' => $file, 'name' => $notename,'share'=>$share]);
        } else if ($user_id !== $login) {
            return redirect('notes/create')->with('alert', '無權限編輯該筆記');
        } else {
            return redirect('notes/create')->with('alert', '無此ID筆記，請新建');
        }
    }

    public function cshow($id,Request $request)
    {

        $jsonname=Note::where('id',$id)->value('textfile');
//        $class=Note::where('id',$id)->value('class');
        $id=Note::where('id',$id)->value('id');

        $uname=User::where('id',$request->user()->id)->value('name');

        $favor=CollectNote::where('note_id',$id)->where('user_id',$request->user()->id)->value('note_id');
        if($favor){
            $favor=1;
        }else{
            $favor=0;
        }

        $score=NoteScore::where('note_id',$id)->where('user_id',$request->user()->id)->value('score');
        if($score){
            $sscore=$score;
        }

        $notename = str_replace(".json","",$jsonname);

//        $notes=Note::where('class',$class)->paginate(1);//分頁測試

//        $file=Storage::disk('public')->get('\\json\\'.$class.'\\'.$jsonname);
        $file = Storage::disk('public')->get('\\json\\' . $jsonname);
//        Storage::allFiles('user_images');


        $comments=Comment::where('note_id',$id)->get();
        return view('notes.classes.show',['id'=>$id,'json'=>$file,'name'=>$notename,'comments'=>$comments,'favor'=>$favor,'uname'=>$uname,'sscore'=>$sscore]);//        return view('notes.classes.show',['id'=>$id,'json'=>$file,'name'=>$notename,'class'=>$class,'comment'=>$comment,'share'=>$share,'favor'=>$favor]);

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
    public function update(Request $request)
    {

        $this->validate($request, [
//            'class' => 'required',
            'notename' => 'required',
            'json' => 'required',
        ]);

        $json=$request->json;
        Storage::disk('public')->put('\\json\\'.$request->notename.'.json', $json);
        $path=$request->notename.'.json';
        Note::whereId($request->id)->update([
            'time'=>now(),
            'textfile'=>$path
        ]);

    }

    public function share(Request $request)
    {

        if($request->has('share')){
            $request->share=1;
        }else{
            $request->share=0;
        }

        Note::whereId($request->id)->update([
            'share' => $request->share,
        ]);

        return redirect('notes/'.$request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Note::where('id', $id);
        $delete->delete();
        return redirect('/mynotes');
    }

    public function search(Request $request)
    {
        $id=$request->user()->id;
        //撈出該學生所有修的課程
        $student=Student::where('user_id',Auth::id())->value('id');
        $courseId = CourseStudent::where('student_id', $student)->get();
        $courseId = $courseId->toArray();
        $courseId = array_column($courseId,'course_id');

        //撈出對應課程id的教材編號
        $textBookId = Textbook::whereIn('course_id',$courseId)->get();
        $textBookId = $textBookId->toArray();
        $textBookId = array_column( $textBookId,'id');
        $search= $request->input('searchs');

        if($search==null){//偵測有無輸入值
            $ans=false;

        }else{
            $ans=true;
        }

        //撈出標題符合關鍵字的筆記，且教材編號等於使用的教材編號
        $searchs=Note::where("title", "like", '%' . $search . '%')
            ->whereIn('textbook_id',$textBookId)
            ->where('share',1)
            ->orWhere('textbook_id', null)
            ->where("title", "like", '%' . $search . '%')
            ->where('share',1)
            ->get();
        return view('notes.search',['searchs'=>$searchs,'ans'=>$ans,'id'=>$id]);

    }

    public function mynote(Request $request)
    {
        $notes=Note::where('user_id',Auth::id())->get();
        return view('notes.mynote',['notes'=>$notes]);
    }
}
