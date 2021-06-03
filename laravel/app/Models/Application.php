<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class Application extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d H:i:s.u';

    protected $fillable = [
        'name',
        'surname',
        'personal_code',
        'home',
        'telephone',
        'email',
        'education',
        'education_code',
        'education_name',
        'year',
        'marks',
        'relatives',
        'branch_id',
        'speciality_id',
        'group_id',
        'secondary_speciality_id',
        'document1',
        'document2',
        'info'
    ];

    public function scopeToday(Builder $query) {
        return $query->whereDate('created_at', Carbon::now());
    }

    public function speciality() {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }

    public function secondary_speciality() {
        return $this->belongsTo(Speciality::class, 'secondary_speciality_id');
    }

    public function getCipherAttribute() {
        $date = Carbon::parse($this->created_at)->format('Y-m-d H:i:s.u');

        return $this->speciality->code.'-'.Application::where('speciality_id', $this->speciality_id)
                ->whereRaw("TIMESTAMPDIFF(MICROSECOND, '{$date}', created_at) <= 0")
                ->count();
    }

    public function group() {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function branch() {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
