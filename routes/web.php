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
//檢視最新公告
Route::get('{information_id}/show',[
    StudentController::class,'information_show'
]) -> name('student.information.show');
//課程頁面
Route::get('/classes/{class}',[CourseController::class,'index'])->name('classes.index')->middleware('auth');
//顯示公告資訊
Route::get('/notices/{id}',[NoticeController::class,'show'])->name('notices.show')->middleware('auth');
//顯示教材
Route::match(['get', 'post'],'/textbooks/show/{id}',[TextbookController::class,'index'])->name('textbooks.show.index')->middleware('auth');
//新增空白筆記
Route::get('notes/create',[NoteController::class,'create'])->name('notes.create');
Route::post('/notes',[NoteController::class,'store'])->name('notes.store');
Route::post('image',[NoteController::class,'image'])->name('notes.image')->where('id', '[0-9]+');
//顯示所有筆記 (筆記列表)
Route::get('/mynotes',[
    NoteController::class,'mynote'])->name('notes.mynotes')
    ->middleware('auth');
//搜尋筆記
Route::get('/notes/search',[NoteController::class,'search'])->name('notes.search')
    ->middleware('auth');
//顯示收藏庫
Route::get('storehose',[CollectNoteController::class,'index'])->name('favor.index');


//新增照片筆記
Route::get('notes/insert',[NoteController::class,'insert'])->name('notes.insert');
Route::post('osimage',[NoteController::class,'osimage'])->name('notes.osimage');
Route::get('notes/pcreate',[NoteController::class,'pcreate'])->name('notes.pcreate');
//新增教材筆記
Route::post('notes/ccreate',[NoteController::class,'ccreate'])->name('notes.mynotes.ccreate');
//顯示教材筆記列表
Route::get('notes/classes/list/{id}',[NoteController::class,'list'])->name('notes.classes.list');


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

//ta首頁  ================ 被我整理到最下面了
//Route::get('/ta',[TaController::class,'index'])->name('ta.index')->middleware('auth');

//ta擔任課程頁面
Route::get('/ta/classes/{class}',[TaController::class,'tacourse'])->name('ta.tacourse');

//添加協作者
Route::post('addass',[NoteController::class,'assist'])->name('notes.assist');


Route::get('/logout',[UserController::class,'logout'])->name('logout');


#學生 -----------------------------
    Route::prefix('students') -> group(function (){
    #首頁
        //常見問題
        Route::get('problem',[
            StudentController::class,'problem'
        ]) -> name('student.problem');
        //校園行事曆
        Route::get('behave',[
            StudentController::class,'behave'
        ]) -> name('student.behave');
        //系統建議
        Route::get('system_suggest',[
            StudentController::class,'system_suggest'
        ]) -> name('student.system_suggest');
    });

#學生課程
    Route::prefix('class')->group(function (){
        //公告列表
        Route::get('{course_id}',[
            CourseController::class,'index'
        ])->name('student.courses.notices');

        //教材區
        Route::get('{course_id}/student_text_materials',[
            TextbookController::class,'index'
        ])->name('student.courses.text_materials');

        //筆記專區
        Route::get('{course_id}/student_BN',[
            NoteController::class,'mynote'
        ])->name('student.courses.BN');

        //聯絡TA
        Route::get('{course_id}/contact_TA',[
            QuestionController::class,'class'
        ])->name('student.courses.contact_TA');
    });

#SendMail
    Route::prefix('{course_id}/mail') -> group(function(){
        //修課學生
        Route::get('index',[
            \App\Http\Controllers\MailController::class,'index'
        ]) -> name('mail.index');

        //新增mail
        Route::get('{user_id}/create',[
            \App\Http\Controllers\MailController::class,'create'
        ]) -> name('mail.create');

        //送出mail
        Route::get('{user_id}/store',[
           \App\Http\Controllers\MailController::class,'store'
        ]);
    });

#教授 ===================
    Route::prefix('teacher')->group(function (){
        //test data
        Route::get('data/{id}',[
            TeacherController::class,'test'
        ])->name('teacher.test');

        //首頁
        Route::get('index',[
            TeacherController::class,'index'
        ])  -> name('teacher.index');

        //檢視公告
        Route::get('{id}/show',[
            TeacherController::class,'information_show'
        ]) -> name('teacher.information.show');

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

            // 顯示公告內容
            Route::get('{notice_id}/show',[
                NoticeController::class,'teacher_notice_show'
            ])->name('teacher.notice.show');

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
        #教材區
                //檢視
                Route::get('text_materials/{TM_id}/show',[
                    TextbookController::class,'teacher_show'
                ]) -> name('teacher.courses.text_materials.show');

            //瀏覽筆記
            Route::get('browse_notes/{TM_id}',[
                NoteController::class,'teacher_list'
            ])->name('teacher.courses.BN');

            //TA 相關事務
            Route::get('TA_office',[
                CourseController::class,'TA_office'
            ])->name('teacher.courses.TA_office');

            //修課學生
            Route::get('course_student',[
                \App\Http\Controllers\CourseStudentController::class,'index'
            ])->name('teacher.courses.course_student');

        #TA相關事務 =========   TAController
            Route::prefix('TA_office')->group(function (){

                Route::get('{student_id}/message',[
                    TaController::class,'message'
                ])->name('teacher.TA.message') ;
            });
        });

    #選擇年度
        // naspace [ teacher/{year_id} ] ================ [ CourseController ]
        Route::prefix('{year}')->group(function (){
            //首頁
            Route::get('{semester}/year',[
                CourseController::class,'year'
            ])->name('teacher.year.index');
        });

    #辦公室 ======================= 進入辦公室
        // url [ teacher/  office ] ====== TeacherController
        Route::prefix('office')->group(function (){
            //首頁
            Route::get('index',[
                TeacherController::class,'office_index'
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
                    CourseController::class,'office_text_materials'
                ])->name('teacher.office.courses.text_materials');

            #教材區
                //url [teacher/office/{course_id/text_materials ]  =======  TextbootController
                Route::prefix('text_materials')->group(function (){
                    //教材檢視
                    Route::post('/show',[
                        TextbookController::class,'office_teacher_show'
                    ])->name('teacher.office.courses.text_materials.show');


                    //教材儲存
                    Route::post('/store',[
                        TextbookController::class,'teacher_store'
                    ])->name('teacher.office.courses.text_materials.store');

                    //教材刪除
                    Route::delete('/{text_id}',[
                        TextbookController::class,'destroy'
                    ])->name('teacher.office.courses.text_materials.delete');
                });



                //瀏覽筆記
                Route::get('home_works',[
                    CourseController::class,'office_BN'
                ])->name('teacher.office.courses.BN');

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
                    Route::get('{receiver_id}/message',[
                        TaController::class,'office_message'
                    ])->name('teacher.office.TA_office.message');

                    //儲存訊息
                    Route::post('{receiver_id}/message/store',[
                        TaController::class,'message_store'
                    ])->name('teacher.office.TA.message.store');

                });

            });


        });

    });

#學生TA的頁面
    Route::prefix('ta')->group(function (){

        //首頁
        Route::get('',[
            TaController::class,'index'
        ])->name('ta.index')->middleware('auth');

        //與老師聯繫
        Route::get('{course_id}/teacher/message',[
            TaController::class,'TA_message'
        ])->name('TA.teacher.message');
    });

#辦公室
    Route::prefix('teacher/office')->group(function () {

        //學期課程複製
        Route::get('semester',[
            TeacherController::class,'office_semester'
        ])->name('teacher.office.semester');

        //學期課程複製 ----> 查year
        Route::get('semester/year/{year}',[
            TeacherController::class,'semester_year'
        ])->name('teacher.office.semester.year');

        //學期課程複製 ----> 查semester
        Route::get('semester/{semester}',[
            TeacherController::class,'semester_semester'
        ])->name('teacher.office.semester.semester');

        //從課程複製
        Route::get('semester/{course_id}/clone_by',[
            TeacherController::class,'semester_CB'
        ])->name('teacher.office.semester.clone_by');

        //從課程複製 ----> 查year
        Route::get('semester/year/{course_id}/{year}',[
            TeacherController::class,'CB_year'
        ])->name('teacher.office.CB.year');

        //從課程複製 ----> 查semester
        Route::get('semester/{course_id}/{semester}',[
            TeacherController::class,'CB_semester'
        ])->name('teacher.office.CB.semester');

        //從課程複製 ----> 查semester
        Route::get('semester/search/{course_id}/{year}/{semester}',[
            TeacherController::class,'CB_complex'
        ])->name('teacher.office.CB.complex');

        //從課程複製 ----> 檢視教材
        Route::get('semester/{course_id}/{by_course_id}/show',[
            TeacherController::class,'CB_show'
        ])->name('teacher.office.CB.show');

        //從課程複製 ----> 確定複製
        Route::get('semester/{course_id}/{by_course_id}/clone',[
            TeacherController::class,'CB_clone'
        ])->name('teacher.office.CB.clone');

        //從課程複製 ----> 新增
        Route::get('semester/{course_id}/{by_course_id}/store',[
            TeacherController::class,'CB_store'
        ])->name('teacher.office.CB.store');

        //從課程副

    });

#管理者
    Route::prefix('admin') -> group(function (){
        //首頁
        Route::get('index',[
            \App\Http\Controllers\AdminController::class,'index'
        ]) -> name('admin.index');

        //新增消息
        Route::get('create',[
            \App\Http\Controllers\AdminController::class,'create'
        ]) -> name('admin.create');

        //儲存消息
        Route::post('store',[
            \App\Http\Controllers\AdminController::class,'store'
        ]) -> name('admin.store');

        //檢視新消息
        Route::get('{news_id}/show',[
            \App\Http\Controllers\AdminController::class,'show'
        ]) -> name('admin.show');

        //修改消息
        Route::get('{news_id}/edit',[
            \App\Http\Controllers\AdminController::class,'edit'
        ]) -> name('admin.edit');

        //修改消息 ------> 更新
        Route::post('{news_id}/update',[
            \App\Http\Controllers\AdminController::class,'update'
        ]) -> name('admin.update');

        //刪除消息
        Route::get('{news_id}/delete',[
            \App\Http\Controllers\AdminController::class,'destroy'
        ]) -> name('admin.destroy');


    #帳號管理
        Route::prefix('account') -> group(function(){

            //首頁
            Route::get('index',[
                \App\Http\Controllers\UserController::class,'index'
            ]) -> name('account.index');

            //查找學生類型
            Route::get('student',[
                \App\Http\Controllers\UserController::class,'search_student'
            ]);

            //查找老師
            Route::get('teacher',[
                \App\Http\Controllers\UserController::class,'search_teacher'
            ]);

            //新增介面
            Route::get('create',[
                UserController::class,'create'
            ]) -> name('account.create');

            //儲存使用者帳號
            Route::post('store',[
                UserController::class,'store'
            ]) -> name('account.store');

            //匯入帳號介面
            Route::get('import',[
                \App\Http\Controllers\ImportController::class,'account_import'
            ]) -> name('account.import');

            //儲存匯入的資料
            Route::post('import/store',[
                \App\Http\Controllers\ImportController::class,'account_store'
            ]) -> name('account.import.store');

            //編輯帳號
            Route::get('{user_id}/edit',[
                UserController::class,'edit'
            ]) -> name('account.edit');

            //更新帳號
            Route::post('{user_id}/update',[
                UserController::class,'update'
            ]) -> name('account.update');

            //刪除帳號
            Route::get('{user_id}/delete',[
                UserController::class,'destroy'
            ]) -> name('account.delete');

        });


    #科系管理
        Route::prefix('department') -> group(function(){
            //首頁
            Route::get('index',[
                \App\Http\Controllers\DepartmentController::class,'index'
            ]) -> name('department.index');

            //新增
            Route::get('create',[
                \App\Http\Controllers\DepartmentController::class,'create'
            ]) -> name('department.create');

            //儲存
            Route::post('store',[
                \App\Http\Controllers\DepartmentController::class,'store'
            ]) -> name('department.store');

            //編輯
            Route::get('{department_id}/edit',[
                \App\Http\Controllers\DepartmentController::class,'edit'
            ]) -> name('department.eidt');

            //更新
            Route::post('{department_id}/update',[
                \App\Http\Controllers\DepartmentController::class,'update'
            ]) -> name('department.update');

            //刪除
            Route::get('{department_id}/delete',[
                \App\Http\Controllers\DepartmentController::class,'destroy'
            ]) -> name('department.delete');

            //課程相關資訊首頁
            Route::get('import',[
                \App\Http\Controllers\ImportController::class,'index'
            ]) -> name('import.index');

            //匯入新學期課程
            Route::post('course/import',[
                \App\Http\Controllers\ImportController::class,'course'
            ]) -> name('import.course');

            //匯入選課資料
            Route::post('course_student/import',[
                \App\Http\Controllers\ImportController::class,'course_student'
            ]) -> name('import.course_student');

        #科系課程管理
            Route::prefix('{department_id}') -> group(function (){
                //首頁
                Route::get('index',[
                    \App\Http\Controllers\DepartmentController::class,'courses_index'
                ])-> name('department.courses_index');

                //首頁 ------> 年份分類
                Route::get('search_year/{year}',[
                    \App\Http\Controllers\DepartmentController::class,'search_year'
                ]) -> name('department.search_year');

                //新增
                Route::get('course_create',[
                    \App\Http\Controllers\CourseController::class,'create'
                ])-> name('course.create');

                //儲存
                Route::post('course_store',[
                    \App\Http\Controllers\CourseController::class,'store'
                ])-> name('course.store');

                //修改
                Route::get('{course_id}/course_edit',[
                    \App\Http\Controllers\CourseController::class,'edit'
                ])-> name('course.edit');

                //更新
                Route::post('{course_id}/course_update',[
                    \App\Http\Controllers\CourseController::class,'update'
                ])-> name('course.update');

                //刪除
                Route::get('{course_id}/course_delete',[
                    \App\Http\Controllers\CourseController::class,'destroy'
                ])-> name('course.destroy');

                //修課學生
                Route::get('{course_id}/students',[
                    \App\Http\Controllers\CourseController::class,'students'
                ]) -> name('course.students');

                //新增修課學生
                Route::get('{course_id}/students/create',[
                    \App\Http\Controllers\CourseStudentController::class,'create'
                ]) -> name('course_student.create');

                //儲存
                Route::get('{course_id}/students/{student_id}/store',[
                    \App\Http\Controllers\CourseStudentController::class,'store'
                ]) -> name('course_student.store');

                //刪除修課學生
                Route::get('{course_id}/{student_id}/delete',[
                    \App\Http\Controllers\CourseStudentController::class,'destroy'
                ]) -> name('course_student.destroy');

            });


        });


    });

