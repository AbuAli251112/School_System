<?php

namespace App\Repository;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Section;

class AttendanceRepository implements AttendanceRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Attendance.Sections',compact('Grades','list_Grades','teachers'));
    }

    public function show($id)
    {
        $grade = Section::where("id", $id)->first(["Grade_id", "Class_id"]);
        $students = Student::with('attendance')->where('grade_id', $grade->Grade_id)->where('classroom_id', $grade->Class_id)->where('section_id', $id)->get();
        return view('pages.Attendance.index',compact('students'));
    }

    public function store($request)
    {
        try {
            foreach ($request->attendences as $studentid => $attendence) {
                if( $attendence == 'presence' ) {
                    $attendence_status = true;
                } else if( $attendence == 'absent' ){
                    $attendence_status = false;
                }
                Attendance::create([
                    'student_id'=> $studentid,
                    'grade_id'=> $request->grade_id,
                    'classroom_id'=> $request->classroom_id,
                    'section_id'=> $request->section_id,
                    'teacher_id'=> 1,
                    'attendence_date'=> date('Y-m-d'),
                    'attendence_status'=> $attendence_status
                ]);
            }

            return redirect()->back()->with('success', trans('messages.success'));

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        // TODO: Implement update() method.
    }

    public function destroy($request)
    {
        // TODO: Implement destroy() method.
    }
}
