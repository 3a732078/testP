<?php

namespace App\Http\Controllers;

use App\Imports\CourseImport;
use App\Imports\CourseStudentImport;
use App\Models\Course;
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
        $request -> validate([
            'course' => 'required|mimes:xlsx'
        ]);
        \Maatwebsite\Excel\Facades\Excel::import(new CourseImport(),$request -> file('course')  );
        $courses = Course::all();
        foreach ($courses as $data){
            if($data -> grade == 1000){
                if (is_numeric(substr($data -> name , -1))){
                    $teacher_count = (int) substr($data -> name , -1);
                }
                if (is_numeric(substr($data -> classroom , -1))){
                    $department_count = (int) substr($data -> name , -1);
                }
            }
        }
        $DeleteC = $courses -> where('grade' , 1000 );
        foreach ($DeleteC as $data){
            $data -> delete();
        }
        if ($teacher_count != null && $teacher_count > 0){
            return redirect() -> route('import.index') -> withErrors($teacher_count,'teacher');
        }
        if ($department_count != null && $department_count > 0){
            return redirect() -> route('import.index')  -> withErrors(' ','department');
        }

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

    //匯入帳號介面
    public function account_import(){
        return view('admin.account.import.create');
    }

    //儲存匯入帳號
    public function account_store(Request $request){
        $request -> validate([
            'user' => 'required|mimes:xlsx',
        ]);

        Excel::import(new UsersImport(),$request -> file('user'));
        $user = User::where('account' , 'Account') -> first () ;
        $user -> delete();

        return back() -> withStatus('Success !!');
    }

}

