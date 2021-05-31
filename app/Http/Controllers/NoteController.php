<?php

namespace App\Http\Controllers;

use App\Models\Assist;
use App\Models\CollectNote;
use App\Models\Comment;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\DefaultNote;
use App\Models\Note;
use App\Models\NoteScore;
use App\Models\Student;
use App\Models\Textbook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function ccreate(Request $request)
    {
        $id=$request->user()->id;
        $class=Student::where('user_id',$id)->value('classroom');
        $classroom=Student::where('classroom',$class)->get();

        $count = count($classroom);
        $classmate=array();
        for($i=0;$i<$count;$i++){
            $uid=$classroom->pluck('user_id');
            $user=User::where('id',$uid[$i])->value('name');
            array_push($classmate,$user);
        }

        $textbookId = $request->textbookId;//教材Id
        $course=Textbook::find($textbookId)->course->name;//課程名稱
        $classId = $request->classId;//課程Id
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
//        dd($images);
        $num = $request->num != null ? $request->num : 1 ;

        return view('notes.mynotes.ccreate',['classmate'=>$classmate,'textbookId'=>$textbookId,'classId'=>$classId,'images'=>$images,'num'=>$num,'textbook'=>$textbook, 'now'=>0,'course'=>$course,'courses'=>$course]);
    }

    public function create(Request $request)
    {
        session_start();
        $classId=$_SESSION['classId'];//課程Id
        $classname = Course::where('id', $classId)->value('name');
        $id=$request->user()->id;
        $class=Student::where('user_id',$id)->value('classroom');
        $classroom=Student::where('classroom',$class)->get();

        $user=Student::where('user_id',$id)->value('id');
        $course=CourseStudent::where('student_id',$user)->get();



        $count = count($classroom);
        $classmate=array();
        for($i=0;$i<$count;$i++){
            $uid=$classroom->pluck('user_id');
            $user=User::where('id',$uid[$i])->value('name');
            array_push($classmate,$user);
        }

        $count2 = count($course);
        $coursename=array();
        for($j=0;$j<$count2;$j++){
            $cid=$course->pluck('course_id');
            $courses=Course::where('id',$cid[$j])->value('name');
            array_push($coursename,$courses);
        }


        return view('notes.create',['classmate'=>$classmate,'classname'=>$classname],['coursename'=>$coursename]);
    }

    public function insert(Request $request)
    {
        $id=$request->user()->id;
        $class=Student::where('user_id',$id)->value('classroom');
        $classroom=Student::where('classroom',$class)->get();

        $user=Student::where('user_id',$id)->value('id');
        $course=CourseStudent::where('student_id',$user)->get();



        $count = count($classroom);
        $classmate=array();
        for($i=0;$i<$count;$i++){
            $uid=$classroom->pluck('user_id');
            $user=User::where('id',$uid[$i])->value('name');
            array_push($classmate,$user);
        }

        $count2 = count($course);
        $coursename=array();
        for($j=0;$j<$count2;$j++){
            $cid=$course->pluck('course_id');
            $courses=Course::where('id',$cid[$j])->value('name');
            array_push($coursename,$courses);
        }


        return view('notes.insert',['classmate'=>$classmate],['coursename'=>$coursename]);
    }

    public function pcreate(Request $request)
    {
        session_start();
        $classId=$_SESSION['classId'];//課程Id
        $classname = Course::where('id', $classId)->value('name');
        $id=$request->user()->id;
        $class=Student::where('user_id',$id)->value('classroom');
        $classroom=Student::where('classroom',$class)->get();

        $user=Student::where('user_id',$id)->value('id');
        $course=CourseStudent::where('student_id',$user)->get();



        $count = count($classroom);
        $classmate=array();
        for($i=0;$i<$count;$i++){
            $uid=$classroom->pluck('user_id');
            $user=User::where('id',$uid[$i])->value('name');
            array_push($classmate,$user);
        }

        $count2 = count($course);
        $coursename=array();
        for($j=0;$j<$count2;$j++){
            $cid=$course->pluck('course_id');
            $courses=Course::where('id',$cid[$j])->value('name');
            array_push($coursename,$courses);
        }


        return view('notes.pcreate',['classmate'=>$classmate,'classname'=>$classname],['coursename'=>$coursename]);
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
            'pages'=>'required',

        ]);
        $json = $request->json;
        $stashJson = json_decode($json);
        foreach ($stashJson as $key => $value) {
//            $stashJson[$key] =
        }
//        dd($json);
//        Storage::disk('public')->put('\\json\\' . $request->class . '\\' . $request->notename . '.json', $json);
        Storage::disk('public')->put('\\json\\' . $request->notename . '.json', $json);
        $path = $request->notename . '.json';
        $className=Course::where('id',$request->classId)->value('name');

        if ($request->has('textbookId')==true){
            Note::create([
                'user_id'=>$request->user()->id,
                'textbook_id'=>$request->textbookId,
                'title'=>$request->notename,
                'attach'=>$className,
                'time'=>now(),
                'page'=>$request->pages,
                'share'=>0,
                'like'=>0,
                'textfile'=>$path
            ]);
        }else{
            if ($request->class==='無分類'){
                Note::create([
                    'user_id'=>$request->user()->id,
                    'title'=>$request->notename,
                    'time'=>now(),
                    'page'=>$request->pages,
                    'share'=>0,
                    'like'=>0,
                    'textfile'=>$path
                ]);
            }else{
                Note::create([
                    'user_id'=>$request->user()->id,
                    'title'=>$request->notename,
                    'attach'=>$request->class,
                    'time'=>now(),
                    'page'=>$request->pages,
                    'share'=>0,
                    'like'=>0,
                    'textfile'=>$path
                ]);
            }
        }
        return redirect('/mynotes');

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
    public function osimage(Request $request)
    {
        session_start();
        $classId=$_SESSION['classId'];//課程Id
        $classname = Course::where('id', $classId)->value('name');
        $this->validate($request, [
            'upphoto' => 'required',
        ]);
//        dd("你有近來");
//        dd($request->upphoto);
//        if($request->file('upphoto')) {
//            $filename = $request->file('upphoto')->getClientOriginalName();
//
//            $request->img->move(public_path() . '\images\photo\\', $filename);
//        }
        $tojson=array();


        $files = $request->file('upphoto');

        if($request->hasFile('upphoto'))
        {
            foreach ($files as $file) {
                $filestore=$file->getClientOriginalName();
                array_push($tojson,$filestore);
                $file->move(public_path() . '\photo\\', $filestore);


            }
        }

        $id=$request->user()->id;
        $class=Student::where('user_id',$id)->value('classroom');
        $classroom=Student::where('classroom',$class)->get();

        $user=Student::where('user_id',$id)->value('id');
        $course=CourseStudent::where('student_id',$user)->get();



        $count = count($classroom);
        $classmate=array();
        for($i=0;$i<$count;$i++){
            $uid=$classroom->pluck('user_id');
            $user=User::where('id',$uid[$i])->value('name');
            array_push($classmate,$user);
        }

        $count2 = count($course);
        $coursename=array();
        for($j=0;$j<$count2;$j++){
            $cid=$course->pluck('course_id');
            $courses=Course::where('id',$cid[$j])->value('name');
            array_push($coursename,$courses);
        }
        $tojsonn=count($tojson);
        $sjson = json_encode($tojson);
//         dd($tojson);
        return view('notes.pcreate',['classmate'=>$classmate,'classname'=>$classname],['coursename'=>$coursename,'sjson'=>$sjson,'tojsonn'=>$tojsonn,'tojson'=>$tojson]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $className=Note::find($id)->attach;
        $className = Course::where('name', $className)->value('name');
        $id1=$request->user()->id;
        $class=Student::where('user_id',$id1)->value('classroom');
        $classroom=Student::where('classroom',$class)->get();

        $count = count($classroom);
        $classmate=array();
        $userid=array();
        for($i=0;$i<$count;$i++){
            $uid=$classroom->pluck('user_id');
            $user=User::where('id',$uid[$i])->value('name');
            $u=User::where('id',$uid[$i])->value('id');
            array_push($classmate,$user);
            array_push($userid,$u);
        }

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
        $assist=Assist::where('user_id',$request->user()->id)->value('note_id');

        if ($id && $user_id === $login) {
            $notename = str_replace(".json", "", $jsonname);

//        $notes=Note::where('class',$class)->paginate(1);//分頁測試

            $file = Storage::disk('public')->get('\\json\\' . $jsonname);
            $ass=Assist::where('note_id',$id)->get();

            if(count($ass)!==0){}
            else $ass=null;


            $course=null;
            $classId=null;
            $textbook=null;
            $images=[[]];
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
            }
            else{
                $images=Note::where('id',$id)->value('page');
            }



            //這個是抓留言資料
//            $comment=Comment::where('note_id',$id)->value('content');
            $uname=User::where('id',$request->user()->id)->value('name');
            $comments=Comment::where('note_id',$id)
                ->where('comment_id',null)
                ->get();
            $replies=Comment::where('note_id',$id)
                ->where('comment_id','!=',null)
                ->get();

            return view('notes.show', ['id' => $id, 'json' => $file, 'name' => $notename,'share'=>$share,'classmate'=>$classmate,'userid'=>$userid,'count'=>$count,'ass'=>$ass,'comments'=>$comments,'replies'=>$replies,'uname'=>$uname,
                'className'=>$className,'textbookId'=>$textbookId,'course'=>$course,'courses'=>$course,'classId'=>$classId,'textbook'=>$textbook,'images'=>$images]);
        }

        $assist2=Assist::where('user_id',$request->user()->id)->get();

        $c=count($assist2);

        if(count($assist2)!==0) {
            for ($i = 0; $i < $count; $i++) {
                $s = $assist2[$i]->note_id;

                if ($s === $id) {
                    $ident = 1;
                    break;
                } else {
                    $ident = 0;
                }
            }
        }
        else if(count($assist2)===0){

        }

        if ($ident === 1) {

            $notename = str_replace(".json", "", $jsonname);

//        $notes=Note::where('class',$class)->paginate(1);//分頁測試

            $file = Storage::disk('public')->get('\\json\\' . $jsonname);
            $ass=Assist::where('note_id',$id)->get();

            if(count($ass)!==0){}
            else $ass=null;

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
            }
            else{
                $images=Note::where('id',$id)->value('page');
            }

            //這個是抓留言資料
//            $comment=Comment::where('note_id',$id)->value('content');
            $uname=User::where('id',$request->user()->id)->value('name');
            $comments=Comment::where('note_id',$id)
                ->where('comment_id',null)
                ->get();
            $replies=Comment::where('note_id',$id)
                ->where('comment_id','!=',null)
                ->get();

            return view('notes.show', ['id' => $id, 'json' => $file, 'name' => $notename,'share'=>$share,'classmate'=>$classmate,'userid'=>$userid,'count'=>$count,'ass'=>$ass,'uname'=>$uname,'comments'=>$comments,'replies'=>$replies,'className'=>$className,'textbookId'=>$textbookId,'course'=>$course,'courses'=>$course,'classId'=>$classId,'textbook'=>$textbook,'images'=>$images]);
        }
        else if ($user_id !== $login || $ident !== 1) {
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

        $dfnote=DefaultNote::where('note_id',$id)->where('user_id',$request->user()->id)->value('note_id');
        if($dfnote){
            $dfnote=1;
        }else{
            $dfnote=0;
        }

        $score=NoteScore::where('note_id',$id)->where('user_id',$request->user()->id)->value('score');
        if($score){
            $sscore=$score;
        }
        else{
        $sscore=null;
        }
        $notename = str_replace(".json","",$jsonname);

//        $notes=Note::where('class',$class)->paginate(1);//分頁測試

//        $file=Storage::disk('public')->get('\\json\\'.$class.'\\'.$jsonname);
        $file = Storage::disk('public')->get('\\json\\' . $jsonname);
//        Storage::allFiles('user_images');

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
        }
        else{
            $images=Note::where('id',$id)->value('page');
        }

        $comments=Comment::where('note_id',$id)
            ->where('comment_id',null)
            ->get();
        $replies=Comment::where('note_id',$id)
            ->where('comment_id','!=',null)
            ->get();
        return view('notes.classes.show',['id'=>$id,'json'=>$file,'name'=>$notename,'comments'=>$comments,'favor'=>$favor,'uname'=>$uname,'sscore'=>$sscore,'replies'=>$replies,'author'=>$author,'textbookId'=>$textbookId,'course'=>$course,'courses'=>$course,'classId'=>$classId,'textbook'=>$textbook,'images'=>$images,'dfnote'=>$dfnote]);//        return view('notes.classes.show',['id'=>$id,'json'=>$file,'name'=>$notename,'class'=>$class,'comment'=>$comment,'share'=>$share,'favor'=>$favor]);
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

        return redirect('/mynotes');
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
        session_start();
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
        $resp=true;

        //學生選修了哪些課
        $studentClass = CourseStudent::where('student_id',$request->user()->student->id)->get()->toArray();
        $courseIds = [];
        for ($i=0;$i<count($studentClass);$i++){
            $courseIds[$i]=$studentClass[$i]['course_id'];
        }
        $course = Course::all()->toArray();
        $courseName = [];
        $arr = array_flip(array_column($course, 'id'));
        foreach($courseIds as $row){
            if (isset($arr[$row])) {
                $courseName[] = $course[$arr[$row]]['name'];
            }
        }

        if (isset($_SESSION['classId'])){
            $class=$_SESSION['classId'];//課程Id
            $ta=$_SESSION['ta'];

            $course = Course::find($class)->name;
            //撈出標題符合關鍵字的筆記，且教材編號等於使用的教材編號
            $searchs=Note::where("textfile", "like", '%' . $search . '%')
                            //條件1(教材筆記
                            ->whereIn('textbook_id',$textBookId)
                            ->where('share',1)

                            //無分類筆記
                            ->orWhere('textbook_id', null)
                            ->where('attach',$course)
                            ->where("textfile", "like", '%' . $search . '%')
                            ->where('share',1)

                            ->orwhere('attach', "like", '%' . $search . '%')
                            ->whereIn('attach',$courseName)
                            ->where('share',1)
                            ->get();
        }else{
            $class=null;
            $ta=null;

            //撈出標題符合關鍵字的筆記，且教材編號等於使用的教材編號
            $searchs=Note::where("textfile", "like", '%' . $search . '%')
                            //教材筆記
                            ->whereIn('textbook_id',$textBookId)
                            ->where('share',1)

                            //無分類筆記
                            ->orWhere('textbook_id', null)
                            ->where("textfile", "like", '%' . $search . '%')
                            ->whereIn('attach',$courseName)
                            ->where('share',1)

                            //搜尋課程
                            ->orwhere('attach', "like", '%' . $search . '%')
                            ->whereIn('attach',$courseName)
                            ->where('share',1)

                            //純筆記
                            ->orWhere('textbook_id', null)
                            ->where('attach',null)
                            ->where("textfile", "like", '%' . $search . '%')
                            ->where('share',1)
                            ->get();

        }
        $id=$request->user()->id;
        return view('notes.search',['searchs'=>$searchs,'ans'=>$ans,'id'=>$id,'class'=>$class,'ta'=>$ta,'courseName'=>$courseName,'resp'=>$resp]);

    }

    public function mynote(Request $request)
    {
        session_start();
        $ta=$_SESSION['ta'];
        $class=$_SESSION['classId'];//課程Id
        //        dd(Course::all()->values('name'),$request->user()->student->id);
        $studentClass = CourseStudent::where('student_id',$request->user()->student->id)->get()->toArray();
        $courseId = [];
        for ($i=0;$i<count($studentClass);$i++){
            $courseId[$i]=$studentClass[$i]['course_id'];
        }

        $course = Course::all()->toArray();
        $courseName = [];
        //1
//        $arr = array_flip(array_column($course, 'id'));
//        foreach($courseId as $row){
//            if (isset($arr[$row])) {
//                $courseName[] = $course[$arr[$row]]['name'];
//            }
//        }
        //2
//        $arr3 = array_combine(array_column($course, 'id'), array_column($course, 'name'));
//        foreach($courseId as $row){
//            if( isset($arr3[$row])){
//                $courseName[] = $arr3[$row];
//            }
//        }

        $arr3 = collect($course)->mapWithKeys(function ($item) {
                return [$item['id'] => $item['name']];
            });
        foreach($courseId as $row){
            if( isset($arr3[$row])){
                $courseName[] = $arr3[$row];
            }
        }

        $notes=Note::where('user_id',Auth::id())->get();
        $assist=Assist::where('user_id',Auth::id())->get()->toArray();
        $assist = array_column($assist, 'note_id');

//        $assist=Note::where('id', $assist)->where('user_id', '!=',Auth::id())->get();
//        dd($assist);
//        $assistNote=array();
//        for($i=1;$i<count($assist);$i++){
//            $assist=Note::where('id', $assist[$i])->where('user_id','!=',Auth::id())->get()->toArray();
//            dd($assist);
//            array_push($assistNote,$assist);
//            if (isset($assist))$assistNote[] = $assist;
//
//        }

        $StringSQL = "('".implode("','", $assist)."')";
        $authId = Auth::id();
        $assist=DB::Select("SELECT * FROM Notes WHERE id IN ".$StringSQL." AND id != ".$authId." ");
//      dd($assist);
        return view('notes.mynote',['notes'=>$notes,'assist'=>$assist,'class'=>$class,'ta'=>$ta,'courseName'=>$courseName]);
    }

    public function assist(Request $request)
    {
        $this->validate($request, [
//            'addp' => 'required',
            'noteid'=>'required'

        ]);

//        dd($request->addp);
        if($request->addp !== null){
        $count=count($request->addp);
//        dd($count);
//        dd($request->addp[1]);
        $delete = Assist::where('note_id', $request->noteid);
        $delete->delete();

        for ($i = 0; $i < $count; $i++) {

//            if($request->has('addp[]')){
            Assist::create([
                'user_id' => $request->addp[$i],
                'note_id'=>$request->noteid,
            ]);
          //}
        }
            }
        else{
        $delete = Assist::where('note_id', $request->noteid);
        $delete->delete();
        }
    }

    public function list($id)
    {
        session_start();
        $class=$_SESSION['classId'];
        $ta=$_SESSION['ta'];
        $tkName=Textbook::find($id)->name;
        $classNotes=Note::where('textbook_id', $id)->where('share', '=', 1)->get()->toArray();

        $NoteScore=DB::select("select note_id, avg(score) as avg from note_scores group by note_id");
        $NoteScore = array_combine(array_column($NoteScore,'note_id'),array_column($NoteScore,'avg'));
        foreach($classNotes as $key => $value){
            $classNotes[$key]['avg'] = isset($NoteScore[$value['id']]) ? (float)$NoteScore[$value['id']] : 0;
        }

        $a = function($a,$b)
        {
            if ($a['avg']==$b['avg']) return 0;
            return ($a['avg']>$b['avg'])?-1:1;
        };
        usort($classNotes,$a);

        return view('notes.classes.list',['class'=>$class,'classNotes'=>$classNotes, 'NoteScore'=>$NoteScore,'tkName'=>$tkName,'ta'=>$ta]);
    }

    public function attach($id)
    {
        session_start();
        $class=$_SESSION['classId'];
        $ta=$_SESSION['ta'];
        $className=Course::find($class)->name;
        $classNotes=Note::where('attach', $className)->where('share', '=', 1)
                            ->where('textbook_id', null)
                            ->get()->toArray();

        $NoteScore=DB::select("select note_id, avg(score) as avg from note_scores group by note_id");
        $NoteScore = array_combine(array_column($NoteScore,'note_id'),array_column($NoteScore,'avg'));
        foreach($classNotes as $key => $value){
            $classNotes[$key]['avg'] = isset($NoteScore[$value['id']]) ? (float)$NoteScore[$value['id']] : 0;
        }

        $a = function($a,$b)
        {
            if ($a['avg']==$b['avg']) return 0;
            return ($a['avg']>$b['avg'])?-1:1;
        };
        usort($classNotes,$a);

        return view('notes.classes.attach',['class'=>$class,'classNotes'=>$classNotes, 'NoteScore'=>$NoteScore,'ta'=>$ta]);
    }

}
