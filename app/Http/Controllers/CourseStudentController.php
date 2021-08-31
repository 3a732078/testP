<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use function PHPUnit\Framework\containsIdentical;

class CourseStudentController extends Controller
{
    public function index($course_id)
    {

    }

    public function create($department_id,$course_id)
    {
        $course = Course::find($course_id);
        $department = Department::find($department_id);
        $students = Student::all() -> sortByDesc('account');
        $students_compare = array();
        $course_students = CourseStudent::where('course_id',$course_id) -> get();
        foreach ($course_students as $data){
            $students_compare[] = Student::find($data -> student_id);
        }
        foreach ($students_compare as $data1){
            $i = 0;
            foreach ($students as $data2){
              if ($data1 -> id == $data2 -> id){
                  $unset[] = $i;
              }
              $i ++;
            }
        }
        rsort($unset);
        foreach ($unset as $data) {
            unset($students[$data]);
        }
        return view('admin.department.courses.students.create',[
            'course' => $course,
            'department' => $department,
            'students' => $students,

        ]);
    }

    public function store(Request $request,$department_id,$course_id,$student_id)
    {
        $studnet = Student::find($student_id);
        $course_student = new CourseStudent();
        $course_student -> student_id = $student_id;
        $course_student -> course_id = $course_id;
        $course_student -> save();

        return redirect() -> route('course_student.create',[$department_id,$course_id]) -> withStatus('新增成功');
    }

    public function show(CourseStudent $courseStudent)
    {
        //
    }

    public function edit(CourseStudent $courseStudent)
    {

    }

    public function update(Request $request, CourseStudent $courseStudent)
    {
        //
    }

    //刪除修課學生
    public function destroy(CourseStudent $courseStudent ,$department_id,$course_id,$student_id)
    {
        $course = Course::find($course_id);
        $student = CourseStudent::where('student_id',$student_id) -> get();
        $student = $student -> where('course_id' ,$course -> id );

        foreach ($student as $data){
            $data -> delete() ;
        } 

        return back() -> withStatus('完成刪除');
    }
}
