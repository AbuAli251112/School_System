<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Students.promotion.index',compact('Grades'));
    }

    public function create()
    {
        $promotions = Promotion::all();
        return view('pages.Students.promotion.management',compact('promotions'));
    }

    public function store($request)
    {

        DB::beginTransaction();
        try {

            $students = student::where('grade_id',$request->Grade_id)->where('classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();
            if($students->count() < 1){
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }
            foreach ($students as $student){
                $ids = explode(',', $student->id);
                Student::whereIn('id', $ids)->update([
                    'Grade_id'=>$request->Grade_id_new,
                    'Classroom_id'=>$request->Classroom_id_new,
                    'section_id'=>$request->section_id_new,
                    'academic_year'=>$request->academic_year_new,
                ]);
                Promotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->Grade_id,
                    'from_Classroom'=>$request->Classroom_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->Grade_id_new,
                    'to_Classroom'=>$request->Classroom_id_new,
                    'to_section'=>$request->section_id_new,
                    'academic_year'=>$request->academic_year,
                    'academic_year_new'=>$request->academic_year_new,
                ]);
            }
            DB::commit();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {

        DB::beginTransaction();
        try {

            if($request->page_id == 1){
                $Promotions = Promotion::all();
                foreach ($Promotions as $Promotion){
                    $ids = explode(',', $Promotion->student_id);
                    Student::whereIn('id', $ids)->update([
                        'Grade_id'=>$Promotion->from_grade,
                        'Classroom_id'=>$Promotion->from_Classroom,
                        'section_id'=> $Promotion->from_section,
                        'academic_year'=>$Promotion->academic_year
                    ]);
                    Promotion::truncate();
                }
                DB::commit();
                return redirect()->back()->with('error', trans('messages.Delete'));
            } else {
                $Promotion = Promotion::findorfail($request->id);
                Student::where('id', $Promotion->student_id)->update([
                        'Grade_id'=>$Promotion->from_grade,
                        'Classroom_id'=>$Promotion->from_Classroom,
                        'section_id'=> $Promotion->from_section,
                        'academic_year'=>$Promotion->academic_year,
                ]);
                Promotion::destroy($request->id);
                DB::commit();
                return redirect()->back()->with('error', trans('messages.Delete'));
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
