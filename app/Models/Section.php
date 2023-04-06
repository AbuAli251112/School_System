<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;
    use HasFactory;

    public $translatable = ['Name_Section'];
    protected $fillable = ['Name_Section','Grade_id','Class_id'];

    protected $table = 'sections';
    public $timestamps = true;

    public function My_classes()
    {
        return $this->belongsTo('App\Models\Classroom', 'Class_id');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher', 'teacher_section');
    }

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade','Grade_id');
    }
}
