<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Authenticatable
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['Name'];
    protected $guarded=[];

    public function genders()
    {
        return $this->belongsTo('App\Models\Gender', 'Gender_id');
    }

    public function Sections()
    {
        return $this->belongsToMany('App\Models\Section', 'teacher_section');
    }

    // public function specializations()
    // {
    //     return $this->hasOne('App\Models\Specialization', 'id');
    // }

    public function specializations()
    {
        return $this->belongsTo('App\Models\Specialization', 'Specialization_id');
    }
}
