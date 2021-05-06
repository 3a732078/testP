<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use App\Models\Ta;
use App\Models\User;
use Illuminate\Http\Request;

class TaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function course(Request $request)
    {
        $student = Student::where('user_id', $request->user()->id)->value('id');

        $course = Ta::where('student_id', $student)->value('course_id');

        $course_name=Course::where('id', $course)->value('name');
        $list=CourseStudent::where('course_id', $course)->where('student_id','!=',$student)->get();

        $count = count($list);

        $student_list=array();
        $stu_id=array();
        $classlist=array();
        for($i=0;$i<$count;$i++) {
            $student_id = $list->pluck('student_id');
            $user=Student::where('id', $student_id[$i])->where('id','!=',$student)->value('user_id');
            $sid =Student::where('id', $student_id[$i])->value('id');
            $class=Student::where('user_id', $user)->value('classroom');
            $stu=User::where('id', $user)->value('name');
            array_push($student_list,$stu);
            array_push($stu_id,$sid);
            array_push($classlist,$class);
        }
        return view('ta.course',['student_list'=>$student_list,'count'=>$count,'course_name'=>$course_name,'stu_id'=>$stu_id,'classlist'=>$classlist]);

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
     * @param  \App\Models\Ta  $ta
     * @return \Illuminate\Http\Response
     */
    public function show(Ta $ta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ta  $ta
     * @return \Illuminate\Http\Response
     */
    public function edit(Ta $ta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ta  $ta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ta $ta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ta  $ta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ta $ta)
    {
        //
    }
}
