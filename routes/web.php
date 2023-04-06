<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Questions\QuestionController;
use App\Http\Controllers\Quizzes\QuizController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Students\AttendanceController;
use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\Students\FeesInvoicesController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\Students\LibraryController;
use App\Http\Controllers\Students\OnlineClassController;
use App\Http\Controllers\Students\PaymentController;
use App\Http\Controllers\Students\ProcessingFeeController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\ReceiptStudentsController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::view('/', 'auth.selection')->middleware("guest")->name("selection");

Route::group([], function () {

    Route::get('/login/{type}', [AuthenticatedSessionController::class, 'loginForm'])->middleware('guest')->name('login.show');

    Route::post('Login', [AuthenticatedSessionController::class, 'login']);

    Route::get('/logout/{type}', [AuthenticatedSessionController::class, 'logout']);

});

require __DIR__ . '/auth.php';

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth' ]], function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::resource('grades', GradeController::class);

    Route::resource('classrooms', ClassroomController::class);

    Route::post('/classrooms/delete_all', [ClassroomController::class, 'delete_all']);

    Route::post('/classrooms/filter_classes', [ClassroomController::class, 'Filter_Classes']);

    Route::resource('section', SectionController::class);

    Route::get("/classes/{id}", [SectionController::class, "getclasses"]);

    Route::post("/upload_attachment", [StudentController::class, 'Upload_attachment']);

    Route::view('add_parent', 'livewire.show_Form');

    Route::resource('attend', AttendanceController::class);

    Route::resource('/teachers', TeacherController::class);

    Route::resource('/students', StudentController::class);

    Route::get('/Get_classrooms/{id}', [StudentController::class, 'Get_classrooms']);

    Route::get('/Get_Sections/{id}', [StudentController::class, 'Get_Sections']);

    Route::get('Download_attachment/{studentname}/{filename}', [StudentController::class, 'Download_attachment']);

    Route::post('Delete_attachment', [StudentController::class, 'Delete_attachment']);

    Route::resource('/graduated', GraduatedController::class);

    Route::resource('/promotion', PromotionController::class);

    Route::resource('/fees', FeesController::class);

    Route::resource('fees_invoices', FeesInvoicesController::class);

    Route::resource('receipt_students', ReceiptStudentsController::class);

    Route::resource('processingfee', ProcessingFeeController::class);

    Route::resource('payment_students', PaymentController::class);

    Route::resource('subjects', SubjectController::class);

    Route::resource('quizzes', QuizController::class);

    Route::resource('questions', QuestionController::class);

    Route::resource('online_classes', OnlineClassController::class);

    Route::get('indirect', [OnlineClassController::class, 'indirectCreate']);

    Route::post('indirect', [OnlineClassController::class, 'storeIndirect']);

    Route::resource('library', LibraryController::class);

    Route::get('download_file/{filename}', [LibraryController::class, 'downloadAttachment']);

    Route::resource('settings', SettingController::class);

});
