<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\DefaultNote;
use App\Models\Note;
use App\Models\Student;
use App\Models\Ta;
use App\Models\Teacher;
use App\Models\Textbook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use NcJoes\OfficeConverter\OfficeConverter;
use Org_Heigl\Ghostscript\Ghostscript;
use Spatie\PdfToImage\Pdf;

class TextbookController extends Controller
{
    public function index(Request $request,$id)
    {
        session_start();
        $ta=$_SESSION['ta'];

        $textbookId=Textbook::where('id',$id)->value('id');//教材Id
        $_SESSION['textbookId']=$textbookId;
        $course=Textbook::find($textbookId)->course->name;//課程名稱
        $class=$_SESSION['classId'];//課程Id
        $textbook=Textbook::find($textbookId);
        $name = $textbook->name;
        $files=scandir("./images/" . "$name");

        $images = array();
        $newImages = array();
        for ($i=0;$i<count($files);$i++){

            if($files[$i]=='.'||$files[$i]=='..'){
                continue;
            }
            $arr = explode('.',$files[$i]);
            $arr = $arr[1];
            $images[] = $files[$i];
        }
        $num = 1;
        foreach ($images as $r)
        {
            $newImages[] = "{$name}{$num}.{$arr}";
            $num++;
        }
//        dd($newImages);
        $def=0;
        $classNotes=Note::where('textbook_id', $id)->where('share', '=', 1)->get()->toArray();
        $newDef = 0;

        if (count($classNotes)>0){
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
            $def=$classNotes[0]['id'];
            $classname=Textbook::where('id',$id)->value('name');
            $newDef=DefaultNote::where('user_id',$request->user()->id)->where('classname',$classname)->value('note_id');
            $newDef = $newDef !== null ? $newDef : 0;

            $num = $request->num != null ? $request->num : 1 ;
            }

        return view('textbooks.index',[
            'id'=>$id,
            'textbookId'=>$textbookId,
            'textbook'=>$textbook,'course'=>$course,'courses'=>$course,'class'=>$class,'newImages'=>$newImages,'def'=>$def, 'newDef'=>$newDef,'ta'=>$ta
        ]);
    }

    public function indext(Request $request)
    {
        $teacher=Teacher::where('user_id',$request->user()->id)->value('id');
        $courses=Course::where('teacher_id',$teacher)->get();
        $ta=$courses;
        if(count($ta)===0)
        {
            $user=User::where('id',$request->user()->id)->value('id');
            $stu=Student::where('user_id',$user)->value('id');
            $tac=Ta::where('student_id',$stu)->value('course_id');
            $courses=Course::where('id',$tac)->get();
        }
        $textbooks=Textbook::all();
        return view('textbooks.indext',['courses'=>$courses,'textbooks'=>$textbooks]);
    }

    //老師檢視教材
    public function teacher_show(Request $request,$course_id,$TM_id){
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //抓取該課程所有公告
        $course = Course::find($course_id);
        $textbooks = $course->textbooks()->get();

        //使用該年度抓取所有課程
        $courses_year = $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortbyDESC('classroom');

        //        return $courses_year;

        //抓取上下學期
        if($course -> semester == 1){
            $semester = '上學期';
        }else{
            $semester = '下學期';
        }

        $teacher=Teacher::where('user_id',$request->user()->id)->value('id');
        $courses=Course::where('teacher_id',$teacher)->get();
        $ta=$courses;
        if(count($ta)===0)
        {
            $user=User::where('id',$request->user()->id)->value('id');
            $stu=Student::where('user_id',$user)->value('id');
            $tac=Ta::where('student_id',$stu)->value('course_id');
            $courses=Course::where('id',$tac)->get();
        }

        $textbooks=Textbook::all();

        $textbookimg=Textbook::find($TM_id);
        $folder=$textbookimg->name;
        $path = public_path('\images\\'.$folder);
//        dd($path);
        $files = File::files($path);
        $count = count($files);
//        dd($files[0]->getFilename());

        $filename=array();
        for($i=0;$i<$count;$i++){
            $fn=$files[$i]->getFilename();
            array_push($filename,$fn);
        }

        return view('teacher.courses.text_materials.show',[
            'year_semester' => $course -> year . "學年度" . $semester,
            'textbooks' => $textbooks,
            'courses_year' => $courses_year,
            'course_id' => $course_id,
            'course' => $course,
            'textbookimg'=>$textbookimg,'files'=>$files,'filesname'=>$filename,'courses'=>$courses,'textbooks'=>$textbooks,'id'=>$TM_id
        ]);
    }

    public function create(Request $request)
    {
        $teacher=Teacher::where('user_id',$request->user()->id)->value('id');
        $courses=Course::where('teacher_id',$teacher)->get();
        $ta=$courses;
        if(count($ta)===0)
        {
            $user=User::where('id',$request->user()->id)->value('id');
            $stu=Student::where('user_id',$user)->value('id');
            $tac=Ta::where('student_id',$stu)->value('course_id');
            $courses=Course::where('id',$tac)->get();
        }

        return view('textbooks.create',['courses'=>$courses]);
    }

    // [ TA放入教材 ]
    public function store(Request $request )
    {
        $validatedData = $request->validate([
            'toimage' => 'required|mimes:docx,doc,pptx,ppt,pdf',
            'title'=>'required',
            'subject'=>'required'
        ]);

        $Name = str_replace(" ","",$request->input('title'));
        $FileName = $Name . '.' . $request->toimage->getClientOriginalExtension();
        $file = $request->file('toimage')->store('pdf');
        $path = Storage::path($file);

        $converter = new OfficeConverter($path);
        $dtp=$converter->convertTo($Name.'.pdf');

        $uploadhash=$request->toimage->hashName();

        $request->toimage->move(public_path().'\images\\'.$Name, $FileName);

        $pdf_file=Storage::path('pdf\\').$Name.'.pdf';
        $output_path=public_path().'\images\\'.$Name.'\\'.$Name.'%d';

        Ghostscript::setGsPath("C:\Program Files\gs\gs9.53.3\bin\gswin64c.exe");
        $pdf=new Pdf($pdf_file);
        $pdf->setOutputFormat('jpeg')->saveImage($output_path);

        Textbook::create([
            'course_id'=>$request->subject,
            'name'=>$Name,
            'path'=>$Name.".pdf",
        ]);

        File::delete(public_path().'\images\\'.$Name.'\\'.$FileName);

        Storage::delete('pdf/'.$uploadhash);

        return back() -> withStatus("success");

    }

    public function teacher_store(Request $request,$course_id){

        $title = $request-> file('file') -> getClientOriginalName();
        $title = str_replace("." . $request->file('file')->getClientOriginalExtension(),"",$title);
        $Name = str_replace(" ","",$title);
        $FileName = $Name . '.' . $request->file->getClientOriginalextension();
        $file = $request->file('file')->store('pdf');
        $path = Storage::path($file);

        $converter = new OfficeConverter($path);
        $dtp=$converter->convertTo($Name.'.pdf');

        $uploadhash=$request->file->hashName();

        $request->file->move(public_path().'\images\\'.$Name, $FileName);

        $pdf_file=Storage::path('pdf\\').$Name.'.pdf';
        $output_path=public_path().'\images\\'.$Name.'\\'.$Name.'%d';

        Ghostscript::setGsPath("C:\Program Files\gs\gs9.53.3\bin\gswin64c.exe");
        $pdf=new Pdf($pdf_file);
        $pdf->setOutputFormat('jpeg')->saveImage($output_path);

        Textbook::create([
            'course_id'=>$course_id,
            'name'=>$Name,
            'path'=>$Name.".pdf",
        ]);

        File::delete(public_path().'\images\\'.$Name.'\\'.$FileName);

        Storage::delete('pdf/'.$uploadhash);
        $status = 1 ;

        return back(302,[
            'status' => $status,
        ]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Textbook  $textbook
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $teacher=Teacher::where('user_id',$request->user()->id)->value('id');
        $courses=Course::where('teacher_id',$teacher)->get();
        $ta=$courses;
        if(count($ta)===0)
        {
            $user=User::where('id',$request->user()->id)->value('id');
            $stu=Student::where('user_id',$user)->value('id');
            $tac=Ta::where('student_id',$stu)->value('course_id');
            $courses=Course::where('id',$tac)->get();
        }

        $textbooks=Textbook::all();

        $textbookimg=Textbook::find($id);
        $folder=$textbookimg->name;
        $path = public_path('\images\\'.$folder);
//        dd($path);
        $files = File::files($path);
        $count = count($files);
//        dd($files[0]->getFilename());

        $filename=array();
        for($i=0;$i<$count;$i++){
            $fn=$files[$i]->getFilename();
            array_push($filename,$fn);
        }
//        dd($filename);
        return view('textbooks.show',[
            'textbookimg'=>$textbookimg,'files'=>$files,'filesname'=>$filename,'courses'=>$courses,'textbooks'=>$textbooks,'id'=>$id
        ]);
    }

    public function edit(Textbook $textbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Textbook  $textbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Textbook $textbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Textbook  $textbook
     * @return \Illuminate\Http\Response
     */

    //刪除教材
    public function destroy($id)
    {
        $text=Textbook::where('id',$id);
        $text->delete();
        return redirect('/textbooks');
    }
}
