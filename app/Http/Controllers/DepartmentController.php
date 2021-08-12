<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Department::all();
        return view('admin.department.index',[
            'departments' => $departments,

        ]);
    }

    public function create()
    {
        return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' => 'required',
        ]);
        $AD = Department::all();

        foreach ($AD as $data){
            if ($data -> name == $request -> name){
                return back()->withErrors('uniqueness','科系名稱不可重複');
            }
        }
        $departmet = new Department();
        $departmet -> name = $request -> name;
        $departmet -> save();

        return redirect('admin/department/index');
    }

    public function show(Department $department)
    {
        //
    }

    public function edit(Department $department , $department_id)
    {
        $department = Department::find($department_id);

        return view('admin.department.edit',[
            'department' => $department,

        ]);
    }

    public function update(Request $request, Department $department,$department_id)
    {
        $request -> validate([
            'name' => 'required',
        ]);

        $departments = Department::all();
        foreach ($departments as $data){
            if ($data -> name == $request -> name){
                return Redirect::back() -> withErrors('科系名稱不可重複' . '(' . $request -> name . ')');
            }else{
                $department = $department -> find($department_id);
                $department -> name = $request -> name ;
                $department -> save();
            }
        }

        return redirect(route('department.index',[

        ]));
    }

    public function destroy(Department $department,$department_id)
    {
        $department = Department::find($department_id);
        $DC = $department -> courses() -> get();
        if(count($DC) > 0 ){
            return Redirect::back() -> withErrors('不可刪除已有課程的科系');
        }else{
            $department -> delete();
        }
        return \redirect() -> route('department.index');
    }

    //課程首頁
    public function courses_index($department_id){
        $department  = Department::find($department_id);
        $courses = $department -> courses() -> get() -> sortbyDesc('year') ;

        foreach ($courses -> unique('year') as $year){
            $datas[] = $courses -> where('year' , $year) -> sortbyDesc('semester');
            foreach ($datas as $data){
                $SortSemester[] = $data;
            }
        }

        return view('admin.department.courses.index',[
            'department' => $department,
            'courses' => $courses,

        ]);
    }

    //課程首頁
    public function search_year($department_id,$year){
        $department  = Department::find($department_id);
        $courses = $department -> courses() -> get() -> sortbyDesc('year')  -> where('year',$year);

        foreach ($courses -> unique('year') as $year){
            $datas[] = $courses -> where('year' , $year) -> sortbyDesc('semester');
            foreach ($datas as $data){
                $SortSemester[] = $data;
            }
        }

        return view('admin.department.courses.index',[
            'department' => $department,
            'courses' => $courses,

        ]);
    }

}
