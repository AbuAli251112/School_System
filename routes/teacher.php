<?php

use App\Http\Controllers\Teacher\dashboard\QuizzController;
use App\Http\Controllers\Teacher\dashboard\StudentController;
use App\Http\Controllers\Teacher\dashboard\QuestionController;
use App\Http\Controllers\Teacher\dashboard\OnlineZoomClassesController;
use App\Http\Controllers\Teacher\dashboard\ProfileController;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Students\StudentController as SC;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']], function () {

    Route::get('/teacher/dashboard', function () {
        $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
        $data['count_sections']= $ids->count();
        $data['count_students']= \App\Models\Student::whereIn('section_id',$ids)->count();
        return view('pages.Teachers.dashboard.dashboard', $data);
    });

    Route::group([], function () {
        Route::get('student', [StudentController::class, 'index']);
        Route::get('sections',[StudentController::class, 'sections']);
        Route::post('attendance',[StudentController::class, 'attendance']);
        Route::post('edit_attendance', [StudentController::class, 'editAttendance']);
        Route::get('attendance_report', [StudentController::class, 'attendanceReport'])->name('attendance.report');
        Route::post('attendance_report', [StudentController::class, 'attendanceSearch'])->name('attendance.search');
        Route::resource('quiz', QuizzController::class);
        Route::resource('question', QuestionController::class);
        Route::resource('online_zoom_classes', OnlineZoomClassesController::class);
        Route::get('/indirect', [OnlineZoomClassesController::class, "indirectCreate"])->name('indirect.teacher.create');
        Route::post('/indirect', [OnlineZoomClassesController::class, "storeIndirect"])->name('indirect.teacher.store');
        Route::get('profile', [ProfileController::class, 'index'])->name('profile.show');
        Route::post('profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('student_quiz/{id}',[QuizzController::class, 'student_quizze'])->name("student.quizze");
        Route::post('repeat_quiz/{quizze_id}', [QuizzController::class, 'repeat_quizze'])->name('repeat.quizze');
        Route::get('/getClassrooms/{id}', [SC::class, 'Get_classrooms']);
        Route::get('/getSections/{id}', [SC::class, 'Get_Sections']);
    });

});
