<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Library;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Storage;

class LibraryRepository implements LibraryRepositoryInterface
{

    public function index()
    {
        $books = Library::all();
        return view('pages.library.index',compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.library.create',compact('grades'));
    }

    public function store($request)
    {
        try {
            $name = $request->file('file_name')->getClientOriginalName();
            $books = new Library();
            $books->title = ["ar" => $request->title_ar, "en" => $request->title_en];
            $books->file_name = $name;
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $books->save();
            $request->file('file_name')->storeAs('books/' , $name, 'library_attachments');
            return redirect('library/create')->with('success', trans('messages.success'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $grades = Grade::all();
        $book = library::findorFail($id);
        return view('pages.library.edit',compact('book','grades'));
    }

    public function update($request)
    {
        try {
            $book = library::findorFail($request->id);
            if($request->hasfile('file_name')){
                Storage::disk("library_attachments")->delete('books/' . $book->file_name);
                $name = $request->file('file_name')->getClientOriginalName();
                $request->file('file_name')->storeAs('books/' , $name, 'library_attachments');
                $book->file_name = $name;
            }
            $book->title = ["ar" => $request->title_ar, "en" => $request->title_en];
            $book->Grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        Storage::disk("library_attachments")->delete('books/' . $request->file_name);
        library::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('library.index');
    }

    public function download($filename)
    {
        return response()->download(storage_path('app/library_attachments/books/' . $filename));
    }
}
