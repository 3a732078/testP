<?php

use App\Http\Controllers\CollectNoteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NoteScoreController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TextbookController;

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[UserController::class,'home'])->name('home');

//學生登入後頁面
Route::middleware(['auth:sanctum,web', 'verified'])->get('/students',[StudentController::class,'index'])
    ->name('students.index');
//課程頁面
Route::get('/classes/{class}',[CourseController::class,'index'])->name('classes.index')->middleware('auth');
//顯示公告資訊
Route::get('/notices/{id}',[NoticeController::class,'show'])->name('notices.show')->middleware('auth');
//顯示所有筆記
Route::get('/mynotes',[NoteController::class,'mynote'])->name('notes.mynotes')->middleware('auth');
//搜尋筆記
Route::get('/notes/search',[NoteController::class,'search'])->name('notes.search')->middleware('auth');

//顯示教材
Route::match(['get', 'post'],'/textbooks/show/{id}',[TextbookController::class,'index'])->name('textbooks.show.index')->middleware('auth');

//新增空白筆記
Route::get('notes/create',[NoteController::class,'create'])->name('notes.create');
Route::post('/notes',[NoteController::class,'store'])->name('notes.store');
Route::post('image',[NoteController::class,'image'])->name('notes.image')->where('id', '[0-9]+');

//新增教材筆記
Route::post('notes/ccreate',[NoteController::class,'ccreate'])->name('notes.mynotes.ccreate');

Route::get('/logout',[UserController::class,'logout'])->name('logout');

//顯示所有TA列表
Route::get('questions',[QuestionController::class,'index'])->name('questions.index');

//查看TA訊息
Route::get('questions/{id}',[QuestionController::class,'show'])->name('questions.show')->where('id', '[0-9]+');

//新增訊息
Route::post('questions',[QuestionController::class,'store'])->name('questions.store')->where('id', '[0-9]+');

//上傳教材
Route::get('textbooks/create',[TextbookController::class,'create'])->name('textbooks.create');
Route::post('/textbooks',[TextbookController::class,'store'])->name('textbooks.store');

//教授 教材列表
Route::get('/textbooks',[TextbookController::class,'indext'])->name('textbooks.indext');

//教授 顯示教材內容
Route::get('textbooks/{id}',[TextbookController::class,'show'])->name('textbooks.show');

//教授 刪除教材
Route::delete('textbooks/{id}',[TextbookController::class,'destroy'])->name('textbooks.destroy')->where('id', '[0-9]+');

//顯示&編輯筆記
Route::get('notes/{id}',[NoteController::class,'show'])->name('notes.show')->where('id', '[0-9]+');
Route::patch('notes',[NoteController::class,'update'])->name('notes.update');

//刪除筆記
Route::delete('notes/{id}',[NoteController::class,'destroy'])->name('notes.destroy')->where('id', '[0-9]+');

//分享/取消分享筆記
Route::patch('share',[NoteController::class,'share'])->name('notes.share')->where('id', '[0-9]+');

//顯示課堂筆記(學生)
Route::get('/notes/classes/{id}', [NoteController::class,'cshow'])->name('notes.classes.cshow')->where('id', '[0-9]+');

//顯示收藏庫
Route::get('storehose',[CollectNoteController::class,'index'])->name('favor.index');

//收藏/取消收藏
Route::post('favor',[CollectNoteController::class,'store'])->name('favor.store');

//筆記留言
Route::post('/comments',[CommentController::class,'store'])->name('comments.store');

//修改留言
Route::post('/comments/edit',[CommentController::class,'edit'])->name('comments.edit');

//刪除留言
Route::delete('/comments/{id}',[CommentController::class,'destroy'])->name('comments.destroy');

//回覆留言
Route::post('/replies',[CommentController::class,'reply'])->name('comments.reply');

//筆記評分
Route::post('score',[NoteScoreController::class,'store'])->name('score.store');

//TA:顯示課堂學生列表
Route::get('ta/course',[TaController::class,'course'])->name('ta.course');

//TA查看學生訊息
Route::get('ta/questions/{id}',[QuestionController::class,'tashow'])->name('questions.tashow')->where('id', '[0-9]+');

//TA回覆
Route::post('ta/questions',[QuestionController::class,'tastore'])->name('questions.tastore')->where('id', '[0-9]+');

//ta首頁
Route::get('/ta', function () {
    return view('ta.index');
});

//添加協作者
Route::post('addass',[NoteController::class,'assist'])->name('notes.assist');

#教授
    Route::prefix('teacher')->group(function (){

    //首頁
        Route::get('',[
            TeacherController::class,'index'
        ])  -> name('teacher.index');

    //課程
        Route::get('{course}',[
            TeacherController::class,'course'
        ])  ->name('teacher.course');
    });
