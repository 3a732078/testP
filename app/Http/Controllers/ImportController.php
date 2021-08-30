<?php

namespace App\Http\Controllers;

use App\Imports\CourseImport;
use App\Imports\CourseStudentImport;
use App\Imports\UsersImport;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Department;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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

        //修正classroom
        $ChangeC = array();
        foreach ($courses as $data){
            if (mb_substr($data -> classroom, -1,1,'utf-8') == "系" ){
                $ChangeC[] = $data;
            }
        }

        foreach ($ChangeC as $data){
            switch ($data -> grade){
                case 1:
                    $CG = '一';
                    break;

                case 2:
                    $CG = '二';
                    break;

                case 3:
                    $CG = '三';
                    break;

                case 4:
                    $CG = '四';
                    break;
            }
            $data -> classroom = '四' . mb_substr($data -> classroom, 1 , 1 ,'utf-8') . $CG . mb_substr($data -> classroom,0 ,1,'utf-8');
            $data -> save();
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
//        return $student = User::where('name','彭暐翔') -> first() -> student;
        $request -> validate([
            'course_student' => 'required|mimes:xlsx'
        ]);
        $BeforeCourses = CourseStudent::all();
        \Maatwebsite\Excel\Facades\Excel::import(new CourseStudentImport(),$request -> file('course_student'));
        $AfterCourses = CourseStudent::all();
        $array_courses = array();
        foreach ($AfterCourses as $AD){
            $flag = 0;
            foreach ($BeforeCourses as $BD){
                if ($BD -> id == $AD -> id){
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                $array_courses[] = $AD;
            }
        }
        $delete_courses = array();
        $errors = '';
        foreach ($array_courses as $data){
            if ($data -> course_id == 1){
                $delete_courses[] = $data;
            }
            if ($data -> course_id == 2){
                $delete_courses[] = $data;
                $errors = 'CourseName';
            }
            if ($data -> course_id == 3){
                $delete_courses[] = $data;
                $errors = 'StudentName';
            }
        }
        foreach ($delete_courses as $data){
            $course_student = CourseStudent::find($data -> id);
            $course_student -> delete();
        }
        if ($errors != null){
            return back() -> withErrors(' ' , $errors);
        }

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

        $before_users = User::all();
        Excel::import(new UsersImport(),$request -> file('user'));
        $user = User::where('account' , 'Account') -> first () ;
        $user -> delete();
        $after_users = User::all();
        //新增學生/老師的資料
        $array_user = array();
        foreach ($after_users as $AD){
            $flag = 0;
            foreach ($before_users as $BD) {
                if ($AD -> id == $BD -> id){
                    $flag = 1;
                }
            }
            if ($flag == 0){
                $array_user[] = $AD;
            }
        }
        foreach ($array_user as $data){
            if ($data -> type == '老師'){
                $teacher = new Teacher();
                $teacher -> user_id = $data -> id;
                $teacher -> department_id = substr($data -> account,4,1);
                $teacher -> save();
            }elseif($data -> type == '學生'){
                $student = new Student();
                $student -> user_id = $data -> id;
                $student -> department_id = substr($data -> account,4,1);
                $department = Department::find(substr($data -> account,4,1));
                $department_name = mb_substr($department -> name,0,1,'utf-8');
                $student -> classroom = '四' . $department_name . '一乙';
                $student -> save();
            }
        }
        return back() -> withStatus('Success !!');
    }

}

