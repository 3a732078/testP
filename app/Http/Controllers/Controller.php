<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function data(){
        //隨機在某個老師的某個課程裡新增公告

        //==== 隨便抓取某個老師的資料
        $teachers = Teacher::all()->sortByDesc('id');
        $ran_teachers = random_int(1,$teachers->first()->id);
        $teacher = $teachers->where('id',$ran_teachers)->first();

        // ======隨便抓取該老師的某個課程
        $courses = Course::all()->where('teacher_id',$teacher->id);
        $deep_courses = 0;
        foreach ($courses as $course){
            $deep_courses ++;
        }
        $ran_courses = random_int(1, $deep_courses);

        return $courses ;
    }
}
