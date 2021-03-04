<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Student;
use App\Models\Ta;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
    public function tastore(Request $request)
    {
        $this->validate($request, [
            'send' => 'required|max:255',
            'stuid'=>'required',
            'taid'=>'required',
            'classid'=>'required'
        ]);
        Question::create([
            'ta_id'=>$request->taid,
            'student_id'=>$request->stuid,
            'course_id'=>$request->classid,
            'title'=>"我覺得title沒有必要",
            'content'=>$request->send,
            'time'=>now(),
            'response'=>"TA",
        ]);
        return redirect('ta/questions/'.$request->stuid);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }
    public function tashow(Request $request,$id){

        $student=Student::where('id',$id)->value('id');
        $loginstudent = Student::where('user_id', $request->user()->id)->value('id');
        $class=Ta::where('student_id', $loginstudent)->value('course_id');
        $ta=Ta::where('student_id', $loginstudent)->value('id');
        $questions=Question::where('ta_id', $ta)->where('student_id', $id)->get();

        return view('questions.tashow',['questions'=>$questions,'id'=>$id,'ta'=>$ta,'class'=>$class]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
