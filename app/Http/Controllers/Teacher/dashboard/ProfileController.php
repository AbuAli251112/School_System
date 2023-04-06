<?php

namespace App\Http\Controllers\Teacher\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;

class ProfileController extends Controller
{
    public function index()
    {
        $information = Teacher::findorFail(auth()->user()->id);
        return view('pages.Teachers.dashboard.profile', compact('information'));
    }

    public function update(Request $request, $id)
    {
        $information = Teacher::findorFail($id);
        if (!empty($request->password)) {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        toastr()->success(trans('messages.Update'));
        return redirect()->back();
    }

}
