<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasTranslations;
    use HasFactory;

    protected $fillable=['Name_Class'];
    public $timestamps = true;
    public $translatable = ['Name_Class'];

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_Id');
    }
}