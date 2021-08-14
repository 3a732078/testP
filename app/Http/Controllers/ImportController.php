<?php

namespace App\Http\Controllers;

use App\Imports\CourseImport;
use App\Imports\CourseStudentImport;
use App\Models\CourseStudent;
use App\Models\Department;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use function Symfony\Component\String\b;

class ImportController extends Controller
{
    public function index(){
        return view('admin.import.index',[

        ]);
    }

    public function course(Request $request){
//        return $request;
        $request -> validate([
            'course' => 'required|mimes:xlsx'
        ]);
        \Maatwebsite\Excel\Facades\Excel::import(new CourseImport(),$request -> file('course'));

        return back() -> withstatus('import successful');
    }

    //匯入選課資料
    public function course_student(Request $request){
//        return $request;
        $request -> validate([
            'course_student' => 'required|mimes:xlsx'
        ]);
        \Maatwebsite\Excel\Facades\Excel::import(new CourseStudentImport(),$request -> file('course_student'));

        return back() -> withstatus('import successful');
    }
}
