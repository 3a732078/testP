<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Calendar;
use App\Models\Information;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Polyfill\Intl\Idn\Info;

class AdminController extends Controller
{
    public function index()
    {
        $informations = Information::all() -> sortByDesc('created_at');
        $calendars = Calendar::all() -> sortByDesc('created_at');

        return view('admin.index',[
            'informations' => $informations,
            'calendars' => $calendars,
        ]);
    }

    public function create()
    {
        return view('admin.information.create');
    }

    public function store(Request $request)
    {
        $request -> validate([
           'title' => 'required',
           'content' => 'required',
        ]);
        $information = new Information();
        $information -> title = $request -> title;
        $information -> content = $request -> content ;
        $information -> poster = Auth::user() -> name ;
        $information -> save();

        return redirect('admin/index');
    }

    public function show(Admin $admin,$news_id)
    {
        $information = Information::find($news_id);

        return view('admin.information.show',[
            'information' => $information,
        ]);
    }

    public function edit(Admin $admin ,$news_id)
    {
        $information = Information::find($news_id);

        return view('admin.information.edit',[
            'information' => $information,
        ]);
    }

    public function update(Request $request, Admin $admin,$news_id)
    {
        $information = Information::find($news_id);
        if (isset($request -> title)){
            $information -> title = $request -> title;
        }
        if (isset($request -> content)){
            $information -> content = $request -> content;
        }
        $information -> save();

        return redirect(route('admin.index'));
    }

    public function destroy(Admin $admin,$news_id)
    {
        Information::find($news_id) -> delete();
        return redirect(route('admin.index'));
    }

    public function account_index(){

    }
}
