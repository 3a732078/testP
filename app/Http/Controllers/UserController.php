<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Ta;
use http\Client\Curl\User;
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

        return view('admin.account.index',[

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
