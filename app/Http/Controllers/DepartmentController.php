<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        return view('admin.department.index',[
            'departments' => $departments,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                return back()->with('message','科系名稱不可重複');
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
                return Redirect::back() -> withErrors(['message'=> '科系名稱不可重複' . '(' . $request -> name . ')' ]);
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
            return Redirect::back() -> withErrors('errors','不可刪除已有課程的科系');
        }else{
            $department -> delete();
        }
        return \redirect() -> route('department.index');
    }
}
