<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

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

    public function scopeToday(Builder $query) {
        return $query->whereDate('created_at', Carbon::now());
    }
}
