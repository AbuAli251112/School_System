<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Nationalite extends Model
{
    use HasFactory;
    use HasTranslations;

    public $fillable = ['Name'];
    public $translatable = ['Name'];
}
