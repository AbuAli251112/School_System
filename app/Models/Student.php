<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['name'];
    protected $guarded =[];

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender', 'gender_id');
    }

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'classroom_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function Nationality()
    {
        return $this->belongsTo('App\Models\Nationalite', 'nationalitie_id');
    }

    public function myparent()
    {
        return $this->belongsTo('App\Models\My_Parent', 'parent_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function student_account()
    {
        return $this->hasMany('App\Models\StudentAccount', 'student_id');
    }

    public function attendance()
    {
        return $this->hasMany('App\Models\Attendance', 'student_id');
    }
    
}
