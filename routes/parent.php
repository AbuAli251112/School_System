<?php

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Parents\dashboard\ChildrenController;

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

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']], function () {

    Route::get('/parent/dashboard', function () {
        $sons = Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.dashboard',compact('sons'));
    })->name('dashboard.parents');

    Route::group([], function () {
        Route::get('children', [ChildrenController::class, "index"])->name('sons.index');
        Route::get('results/{id}', [ChildrenController::class, "results"])->name('sons.results');
        Route::get('attendances', [ChildrenController::class, "attendances"])->name('sons.attendances');
        Route::post('attendances',[ChildrenController::class, "attendanceSearch"])->name('sons.attendance.search');
        Route::get('fee', [ChildrenController::class, "fees"])->name('sons.fees');
        Route::get('receipt/{id}', [ChildrenController::class, "receiptStudent"])->name('sons.receipt');
        Route::get('profile/parent', [ChildrenController::Class, "profile"])->name('profile.show.parent');
        Route::post('profile/parent/{id}', [ChildrenController::Class, "update"])->name('profile.update.parent');
    });

});
