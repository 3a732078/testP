<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Ta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home(Request $request)
    {
        if(Auth::check()) {

            switch (Auth::user()->type) {
                case '學生':

                    $stu=Student::where('user_id',Auth::user()->id)->value('id');
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
                    return redirect('/admin/index');

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

    public function store(Request $request)
    {
        //
    }

    public function show(Admin $admin)
    {
        //
    }

    public function edit(Admin $admin)
    {
        //
    }

    public function update(Request $request, Admin $admin)
    {
        //
    }

    public function destroy(Admin $admin)
    {
        //
    }
}
