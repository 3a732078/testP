<?php

namespace App\Http\Controllers;

use App\Models\Textbook;
use Illuminate\Http\Request;

class TextbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $files=scandir('./images/統計學測試');
        $images = array();
//        dd($legth);
        for ($i=0;$i<count($files);$i++){

            if($files[$i]=='.'||$files[$i]=='..'){
                continue;
            }
            $images[]=$files[$i];
        }
        $num = $request->num != null ? $request->num : 1 ;

        return view('textbooks.index',['images'=>$images],['num'=>$num]);
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
     * @param  \App\Models\Textbook  $textbook
     * @return \Illuminate\Http\Response
     */
    public function show(Textbook $textbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Textbook  $textbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Textbook $textbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Textbook  $textbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Textbook $textbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Textbook  $textbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Textbook $textbook)
    {
        //
    }
}
