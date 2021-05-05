<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'personal_code',
        'home',
        'telephone',
        'education',
        'education_code',
        'education_name',
        'year',
        'marks',
        'relatives',
        'speciality',
        'document1',
        'document2',
        'info'
    ];
}
