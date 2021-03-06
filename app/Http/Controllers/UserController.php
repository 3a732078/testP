<?php

namespace App\Http\Controllers;
use App\Models\CourseStudent;
use App\Models\Department;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Ta;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function home(Request $request)
    {
        if(Auth::check()) {

            switch (Auth::user()->type) {
                case '學生':

                    $stu=Student::where('user_id',Auth::user()->id)->value('id');
                    $ta=Ta::where('student_id',$stu)->value('id');
                    $ta=Ta::where('student_id',$stu)->value('id');

                    if($ta===null){
                        $ta=0;
                    }

                    return redirect('students')->with('ta',$ta);
                    break;

                case '老師':
                    return redirect('/teacher/index');
                    break;

                case '管理者':
                    return redirect() -> route('admin.index');

            }
        }
        return view('auth/login');
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('home');
        }
    }

    public function index(Request $request)
    {
        $users = User::all();
        $admins = $users -> where('type', '管理者');
        foreach ($admins as $data){
            unset($users[$data -> id - 1 ]);
        }

        return view('admin.account.index',[
            'users' => $users,

        ]);
    }

    //查找學生類型
    public function search_student(){
        $users = User::all();
        $admins = $users -> where('type', '管理者');
        foreach ($admins as $data){
            unset($users[$data -> id - 1 ]);
        }
        $users = $users ->where('type' , '學生');

        return view('admin.account.index',[
            'users' => $users,
        ]);
    }

    //查找老師類型
    public function search_teacher(){
        $users = User::all();
        $admins = $users -> where('type', '管理者');
        foreach ($admins as $data){
            unset($users[$data -> id - 1 ]);
        }
        $users = $users ->where('type' , '老師');

        return view('admin.account.index',[
            'users' => $users,
        ]);
    }

    //新增帳號介面
    public function create(){
        $departments = Department::all();
        return view('admin.account.create',[
            'departments' => $departments,
        ]);
    }

    //儲存帳號
    public function store(Request $request)
    {
        $request -> validate([
            'user_name' => 'required',
            'DepartmentName' => 'required',
            'Type' => 'required',
        ]);
        if($request -> Type == '學生'){
            $request -> validate([
               'class' => 'required',
               'grade' => 'required',
            ]);
        }

        $users = User::all();
        $departments = Department::all();
        $department = Department::where('name' , $request -> DepartmentName) -> first();
        $year = date('Y') - 1911;
        $month = date('m');
        $data_account = array();

        if ($request -> Type == "老師") {
            $users = $users -> where('type', '老師') ;
            if ($month > 6){
                foreach ($users as $data){
                    if( substr($data -> account,1, 4 ) == $year . $department -> id){
                        $data_account[] = $data -> account  ;
                    }
                }
                if (count($data_account) > 0){
                    rsort($data_account);
                    $user = new User();
                    $user -> account = 'T' . $year . $department -> id . substr(number_format((float)substr($data_account[0],5,3) / 100 + 0.01 , '2' , '.' , '' ) , 0 ,1) . substr(number_format((float)substr($data_account[0],5,3) / 100 + 0.01 , '2' , '.', '' ) , 2 ,2);
                    $user -> name = $request -> user_name ;
                    $user -> password = Hash::make('123123123');
                    $user -> type = '老師';
                    $user -> status = '使用';
                    $user -> save();
                }else{
                    $user = new User();
                    $user -> account = 'T' . $year . $department -> id . '001';
                    $user -> name = $request -> user_name ;
                    $user -> password = Hash::make('123123123');
                    $user -> type = '老師';
                    $user -> status = '使用';
                    $user -> save();
                }
            }else{
                foreach ($users as $data){
                    if( substr($data -> account,1, 4 ) == $year - 1 . $department -> id){
                        $data_account[] = $data -> account  ;
                    }
                }
                if (count($data_account) > 0){
                    rsort($data_account);
                    $user = new User();
                    $user -> account = 'T' . $year - 1 . $department -> id . substr(number_format((float)substr($data_account[0],5,3) / 100 + 0.01 , '2' , '.' , '' ) , 0 ,1) . substr(number_format((float)substr($data_account[0],5,3) / 100 + 0.01 , '2' , '.', '' ) , 2 ,2);
                    $user -> name = $request -> user_name ;
                    $user -> password = Hash::make('123123123');
                    $user -> type = '老師';
                    $user -> status = '使用';
                    $user -> save();
                }else{
                    $user = new User();
                    $user -> account = 'T' . $year - 1 . $department -> id . '001';
                    $user -> name = $request -> user_name ;
                    $user -> password = Hash::make('123123123');
                    $user -> type = '老師';
                    $user -> status = '使用';
                    $user -> save();
                }
            }
        }else{
            $users = $users -> where('type', '學生') ;
            if ($month > 6){
                foreach ($users as $data){
                    if( substr($data -> account,1, 4 ) == $year . $department -> id){
                        $data_account[] = $data -> account  ;
                    }
                }
                if (count($data_account) > 0){
                    rsort($data_account);
                    $user = new User();
                    $user -> account = 'S' . $year . $department -> id . substr(number_format((float)substr($data_account[0],5,3) / 100 + 0.01 , '2' , '.' , '' ) , 0 ,1) . substr(number_format((float)substr($data_account[0],5,3) / 100 + 0.01 , '2' , '.', '' ) , 2 ,2);
                    $user -> name = $request -> user_name ;
                    $user -> password = Hash::make('123123123');
                    $user -> type = '學生';
                    $user -> status = '使用';
                    $user -> save();
                }else{
                    $user = new User();
                    $user -> account = 'S' . $year . $department -> id . '001';
                    $user -> name = $request -> user_name ;
                    $user -> password = Hash::make('123123123');
                    $user -> type = '學生';
                    $user -> status = '使用';
                    $user -> save();
                }
            }else{
                foreach ($users as $data){
                    if( substr($data -> account,1, 4 ) == $year - 1 . $department -> id){
                        $data_account[] = $data -> account  ;
                    }
                }
                if (count($data_account) > 0){
                    rsort($data_account);
                    $user = new User();
                    $user -> account = 'S' . $year - 1 . $department -> id . substr(number_format((float)substr($data_account[0],5,3) / 100 + 0.01 , '2' , '.' , '' ) , 0 ,1) . substr(number_format((float)substr($data_account[0],5,3) / 100 + 0.01 , '2' , '.', '' ) , 2 ,2);
                    $user -> name = $request -> user_name ;
                    $user -> password = Hash::make('123123123');
                    $user -> type = '學生';
                    $user -> status = '使用';
                    $user -> save();
                }else{
                    $user = new User();
                    $user -> account = 'S' . $year - 1 . $department -> id . '001';
                    $user -> name = $request -> user_name ;
                    $user -> password = Hash::make('123123123');
                    $user -> type = '學生';
                    $user -> status = '使用';
                    $user -> save();
                }
            }
        }
        $user = User::all() -> sortByDesc('id') -> first();
        if($user -> type == '老師'){
            $teacher = new Teacher();
            $teacher -> user_id = $user -> id;
            $teacher -> department_id = substr($user -> account,4,1);
            $teacher -> save();
        }else{
            $student = new Student();
            $student -> user_id = $user -> id ;
            $student -> department_id = substr($user -> account,4,1);
            $student -> classroom = '四' . mb_substr($request -> DepartmentName , 0,1,'utf-8') . $request -> grade . $request -> class;
            $student -> save();
        }

        return back() -> withStatus('Success');
    }

    public function show(Admin $admin)
    {

    }


    public function edit(Admin $admin ,$user_id)
    {
        $user = User::find($user_id);

        return view('admin.account.edit',[
            'user' => $user,

        ]);
    }

    public function update(Request $request, Admin $admin ,$user_id)
    {
        $request -> validate([
            'account'=> 'required',
            'name' => 'required',
        ]);
        if ($request -> password){
            if(Hash::check($request -> password ,Auth::user() -> password)){
                return back() -> withErrors('與前密碼相同','password');
            }
        }
        if ($request -> email){
            if(substr($request -> email ,-10) != '@gmail.com'){
                return back() -> withErrors('','email');
            }
        }

        $user = User::find($user_id);
        if($request -> password != null){
            $user -> password = Hash::make($request -> password);
        }
        $user -> account = $request -> account;
        $user -> name = $request -> name;
        $user -> type = $request -> type;
        if($request -> email != null){
            $user -> email = $request -> email;
        }
        $user -> status = $request -> status ;
        $user -> save();

        return redirect() -> route('account.index',[

        ]) -> withStatus('更新使用者資料成功');
    }

    public function destroy(Admin $admin,$user_id)
    {
        $user = User::find($user_id);
        if($user -> type == '老師'){
            $courses = $user -> teacher ->  courses() -> get();
        } else{
            $courses = CourseStudent::where('student_id', $user -> student -> id) -> get();
        }
        if (count($courses) > 0 ){
            return back() -> withErrors(' ','error');
        }
        if ($user -> type == '老師'){
            $user -> teacher -> delete();
        }else{
            $user -> student -> delete();
        }
        $user -> delete();
        return  back() -> withstatus('已刪除帳號資料');
    }
}
