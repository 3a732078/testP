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
use App\Http\Controllers\DefaultNoteController;

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

//新增照片筆記
Route::get('notes/insert',[NoteController::class,'insert'])->name('notes.insert');
Route::post('osimage',[NoteController::class,'osimage'])->name('notes.osimage');
Route::get('notes/pcreate',[NoteController::class,'pcreate'])->name('notes.pcreate');


//新增教材筆記
Route::post('notes/ccreate',[NoteController::class,'ccreate'])->name('notes.mynotes.ccreate');

//顯示教材筆記列表
Route::get('notes/classes/list/{id}',[NoteController::class,'list'])->name('notes.classes.list');

Route::get('/logout',[UserController::class,'logout'])->name('logout');

//顯示所有TA列表
Route::get('questions',[QuestionController::class,'index'])->name('questions.index');

//顯示特定課堂TA
Route::get('questions/classes/{class}',[QuestionController::class,'class'])->name('questions.class');

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

//顯示教材筆記(學生)
Route::get('/notes/classes/{id}', [NoteController::class,'cshow'])->name('notes.classes.cshow')->where('id', '[0-9]+');

//"無引用教材"筆記列表
Route::get('/notes/classes/attach/{id}', [NoteController::class,'attach'])->name('notes.classes.attach')->where('id', '[0-9]+');

//顯示收藏庫
Route::get('storehose',[CollectNoteController::class,'index'])->name('favor.index');

//收藏/取消收藏
Route::post('favor',[CollectNoteController::class,'store'])->name('favor.store');

//預設筆記/取消預設
Route::post('def',[DefaultNoteController::class,'store'])->name('def.store');

//瀏覽預設筆記
Route::get('/def/{id}',[DefaultNoteController::class,'show'])->name('def.show');

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
Route::get('ta/course/{class}',[TaController::class,'course'])->name('ta.course');

//TA查看學生訊息
Route::get('ta/questions/{id}',[QuestionController::class,'tashow'])->name('questions.tashow')->where('id', '[0-9]+');

//TA回覆
Route::post('ta/questions',[QuestionController::class,'tastore'])->name('questions.tastore')->where('id', '[0-9]+');

//ta首頁
Route::get('/ta',[TaController::class,'index'])->name('ta.index')->middleware('auth');

//ta擔任課程頁面
Route::get('/ta/classes/{class}',[TaController::class,'tacourse'])->name('ta.tacourse');


//添加協作者
Route::post('addass',[NoteController::class,'assist'])->name('notes.assist');

#教授 ===================
    Route::prefix('teacher')->group(function (){
        //test data
        Route::get('data',[
            TeacherController::class,'test'
        ])->name('teacher.test');

        //首頁
        Route::get('index',[
            TeacherController::class,'index'
        ])  -> name('teacher.index');

        //常見問題
        Route::get('problem',[
            TeacherController::class,'problem'
        ])  -> name('teacher.problem');

        //行事曆
        Route::get('behave',[
            TeacherController::class,'behave'
        ])  -> name('teacher.behave');

        //系統建議
        Route::get('system_suggest',[
            TeacherController::class,'system_suggest'
        ])  -> name('teacher.system_suggest');

    #選擇課程
        // namespace[teacher/{course_id}} ] ======= CourseController
        Route::prefix('{course_id}')->group(function (){
            //首頁(預設公告)
            Route::get('courses',[
                CourseController::class,'courses'
            ])->name('teacher.courses.notices');

        #選擇公告
            // url [teacher/{course_id}/course] ======= NoticeController
            Route::prefix('courses')->group(function (){

                // 顯示公告內容
                Route::get('{notice_id}/show',[
                    NoticeController::class,'teacher_notice_show'
                ])->name('teacher.notice.show');

            });
    #選擇課程
        // namespace[teacher/{course_id}} ] ======= CourseController
            //教材區
            Route::get('text_materials',[
                CourseController::class,'text_materials'
            ])->name('teacher.courses.text_materials');

            //評量區
            Route::get('home_works',[
                CourseController::class,'home_works'
            ])->name('teacher.courses.home_works');

            //TA 相關事務
            Route::get('TA_office',[
                CourseController::class,'TA_office'
            ])->name('teacher.courses.TA_office');
        });

    #選擇年度
        // naspace [ teacher/{year_id} ] ================ [ CourseController ]
        Route::prefix('{year}')->group(function (){
            //首頁
            Route::get('{semester}/year',[
                CourseController::class,'year'
            ])->name('teacher.year.index');
        });

    #辦公室
        // url [ teacher/  office ] ====== TeacherController
        Route::prefix('office')->group(function (){
            //首頁
            Route::get('index',[
                TeacherController::class,'index_office'
            ])  -> name('teacher.office.index');

            //常見問題
            Route::get('problem',[
                TeacherController::class,'problem'
            ])  -> name('teacher.office.problem');

            //行事曆
            Route::get('behave',[
                TeacherController::class,'behave'
            ])  -> name('teacher.office.behave');

            //系統建議
            Route::get('system_suggest',[
                TeacherController::class,'system_suggest'
            ])  -> name('teacher.office.system_suggest');

        #選擇課程
            // namespace[teacher/  office /{course_id}} ] ======= CourseController
            Route::prefix('{course_id}')->group(function (){
                //首頁(預設公告)
                Route::get('courses',[
                    CourseController::class,'office_courses'
                ])->name('teacher.office.courses.notices');

            #選擇公告
                // url [teacher/office/{course_id}/courses] ======= NoticeController
                    /* useful code
                     ,[$course_id,$notice -> id]
                     */
                Route::prefix('courses')->group(function (){

                    // 顯示公告內容
                    Route::get('{notice_id}/show',[
                        NoticeController::class,'teacher_office_notice_show'
                    ])->name('teacher.office.notice.show');

                    // 新增公告內容
                    Route::get('notice/create',[
                        NoticeController::class,'teacher_office_notice_create'
                    ])->name('teacher.office.notice.create');

                    // 儲存公告內容
                    Route::post('notices',[
                        NoticeController::class,'teacher_office_notice_store'
                    ])->name('teacher.office.notice.store');

                    // 修改公告內容
                    Route::get('{notice_id}/edit',[
                        NoticeController::class,'teacher_office_notice_edit'
                    ])->name('teacher.office.notice.edit');

                    // 更新公告內容
                    Route::put('notice/{notice_id}',[
                        NoticeController::class,'teacher_office_notice_update'
                    ])->name('teacher.office.notice.update');

                    // 刪除公告內容
                    Route::delete('notice/{notice_id}',[
                        NoticeController::class,'teacher_office_notice_destory'
                    ])->name('teacher.office.notice.destory');

                });
        #選擇課程
            // namespace[teacher/ office /{course_id}} ] ======= CourseController
                //教材區
                Route::get('text_materials',[
                    CourseController::class,'text_materials'
                ])->name('teacher.office.courses.text_materials');

                //評量區
                Route::get('home_works',[
                    CourseController::class,'home_works'
                ])->name('teacher.office.courses.home_works');

                //TA 相關事務
                Route::get('TA_office',[
                    CourseController::class,'office_TA_office'
                ])->name('teacher.office.courses.TA_office');

            #TA相關事務
                // url [teacher/ office /{$course_id}/TA_office ] ===== TAController
                Route::prefix('TA_office')->group(function (){

                    //設定TA
                    Route::get('create',[
                        TaController::class,'create'
                    ])->name('teacher.office.courses.TA_office.create');

                    //儲存
                    Route::get('{student_id}/store',[
                        TaController::class,'store'
                    ])->name('teacher.office.courses.TA_office.store');

                    //刪除
                    Route::get('{student_id}/delete',[
                        TaController::class,'destroy'
                    ])->name('teacher.office.courses.TA.delete');



                    //與TA聯繫
                    Route::get('{TA_id}/message',[
                        TaController::class,'message'
                    ])->name('teacher.office.courses.TA_office.message');

                });

            });


        });

    });

