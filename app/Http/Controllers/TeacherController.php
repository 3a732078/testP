<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notice;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
//    {}
//    public function fack()
    {
        return view('teacher.index',[
        ]);
    }

    public function year(Request $request , $yead_id)
    {
//        抓取該教授的所有課程
//        $courses = User::find(Auth::id())->teacher()->first()->courses()->get();

        return view('teacher.year.index',[
            'year' => $yead_id,
        ]);
    }

    public function course(Request $request,$year_id,$course_id){
//        抓取該教授的所有課程
//        $courses = User::find(Auth::id())->teacher()->first()->courses()->get();
        $course = Course::find($course_id);
        $notices = Notice::all();
        $user = User::find(Auth::id());
        return view('teacher.course.index',[
            'course' => $course,
            'notices' => $notices,
            'user' => $user,
        ]);

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
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    public function TA(){
        $courses = User::find(Auth::id())->teacher()->first()->courses()->get();

        return view('teacher.ta',[
            'courses' => $courses,
        ]);
    }

    public function test(Teacher $teacher)
    {
        return view('teacher.data');
    }


}
