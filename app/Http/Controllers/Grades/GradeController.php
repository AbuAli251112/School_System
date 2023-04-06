<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $Grades = Grade::all();
    return view('pages.Grades.Grades', compact('Grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    try {
      $Grade = new Grade();
      $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
      $Grade->Notes = $request->Notes;
      $Grade->save();
      
      return redirect('/grades')->with('success', trans('messages.success'));
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error Occured');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(StoreGrades $request)
  {
    try {
      $Grades = Grade::findOrFail($request->id);
      $Grades->update([
        $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
        $Grades->Notes = $request->Notes,
      ]);

      return redirect('/grades')->with('success', trans('messages.Update'));
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {

    $MyClass_id = Classroom::where('Grade_id',$request->id)->pluck('Grade_id');
    if($MyClass_id->count() == 0){
        $Grades = Grade::findOrFail($request->id)->delete();
        return redirect('grades')->with('success', trans('messages.Delete'));
    }
    else{
        return redirect('grades')->with('error', trans('Grades_trans.delete_Grade_Error'));
    }
  }

}

?>
