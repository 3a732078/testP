<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Course;
use App\Models\Information;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
#首頁
    public function index()
    {
        $type= User::where('id', Auth::id())->value('type');
        $informations = Information::all() -> sortByDesc('created_at');
        $calendars = Calendar::all() -> sortByDesc('created_at');
        if ($type=='學生'){
            session_start();
            unset($_SESSION['classId']);
            unset($_SESSION['textbookId']);
            unset($_SESSION['ta']);

            return view('students.index',[
                'informations' => $informations,
                'calendera' => $calendars,
            ]);

        }
    }

    //檢視最新消息
    public function information_show($id){
        $information = Information::find($id);
        return view('students.information',[
            'information' => $information,
        ]);
    }

    //常見問題
    public function problem()
    {
        $type= User::where('id', Auth::id())->value('type');
        if ($type=='學生'){
            session_start();
            unset($_SESSION['classId']);
            unset($_SESSION['textbookId']);
            unset($_SESSION['ta']);

            return view('students.problem');

        }

    }

    //校園行事曆
    public function behave()
    {
        $type= User::where('id', Auth::id())->value('type');
        if ($type=='學生'){
            session_start();
            unset($_SESSION['classId']);
            unset($_SESSION['textbookId']);
            unset($_SESSION['ta']);

            return view('students.behave');

        }
    }

    //系統建議
    public function system_suggest()
    {
        $type= User::where('id', Auth::id())->value('type');
        if ($type=='學生'){
            session_start();
            unset($_SESSION['classId']);
            unset($_SESSION['textbookId']);
            unset($_SESSION['ta']);

            return view('students.system_suggest');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
