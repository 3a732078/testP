<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Textbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use NcJoes\OfficeConverter\OfficeConverter;
use Org_Heigl\Ghostscript\Ghostscript;
use Spatie\PdfToImage\Pdf;

class TextbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        session_start();
        $class=$_SESSION['classId'];

        $files=scandir('./images/統計學測試');
        $images = array();
        for ($i=0;$i<count($files);$i++){

            if($files[$i]=='.'||$files[$i]=='..'){
                continue;
            }
            $images[]=$files[$i];
        }
        $num = $request->num != null ? $request->num : 1 ;

        return view('textbooks.index',['images'=>$images,'class'=>$class,'id'=>$id],['num'=>$num]);
    }

    public function indext(Request $request)
    {
        $teacher=Teacher::where('user_id',$request->user()->id)->value('id');
        $courses=Course::where('teacher_id',$teacher)->get();
        $textbooks=Textbook::all();
        return view('textbooks.indext',['courses'=>$courses,'textbooks'=>$textbooks]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $teacher=Teacher::where('user_id',$request->user()->id)->value('id');
        $courses=Course::where('teacher_id',$teacher)->get();
        return view('textbooks.create',['courses'=>$courses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'toimage' => 'required|mimes:docx,doc,pptx,ppt',
            'title'=>'required',
            'subject'=>'required'
        ]);
        $Name = str_replace(" ","",$request->input('title'));
        $FileName = $Name . '.' . $request->toimage->extension();


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
        return view('textbooks.show',['textbookimg'=>$textbookimg,'files'=>$files,'filesname'=>$filename,'courses'=>$courses,'textbooks'=>$textbooks,'id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Textbook  $textbook
     * @return \Illuminate\Http\Response
     */
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
    public function destroy($id)
    {
        $text=Textbook::where('id',$id);
        $text->delete();
        return view('teacher.index');
    }
}
