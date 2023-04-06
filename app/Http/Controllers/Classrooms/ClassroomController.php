<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $My_Classes = Classroom::all();
        $Grades = Grade::all();
        return view('pages.My_Classes.My_Classes', compact('My_Classes', 'Grades'));
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
    public function store(StoreClassroom $request)
    {
        $List_Classes = $request->List_Classes;
        try {
            foreach ($List_Classes as $List_Class) {
                $My_Classes = new Classroom();
                $My_Classes->Name_Class = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];
                $My_Classes->Grade_id = $List_Class['Grade_id'];
                $My_Classes->save();
            }

            return redirect('classrooms')->with('success', trans('messages.success'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $Classrooms = Classroom::findOrFail($request->id);
            $Classrooms->update([
                $Classrooms->Name_Class = ['ar' => $request->Name, 'en' => $request->Name_en],
                $Classrooms->Grade_id = $request->Grade_id,
            ]);

            return redirect('classrooms')->with('success', trans('messages.Update'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Classrooms = Classroom::findOrFail($request->id)->delete();
        return redirect('classrooms')->with('success', trans('messages.Delete'));
    }


    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);
        Classroom::whereIn('id', $delete_all_id)->Delete();
        return redirect('/classrooms')->with('error', trans('messages.Delete'));
    }

    public function Filter_Classes(Request $request)
    {
        $Grades = Grade::all();
        $Search = Classroom::select('*')->where('Grade_Id', '=', $request->Grade_id)->get();
        return view('pages.My_Classes.My_Classes', compact('Grades', 'Search'));
    }
}
