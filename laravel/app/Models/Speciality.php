<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $table = 'specialities';

    protected $fillable = [
        'name',
        'class',
        'speciality',
        'code',
        'branch_id',
    ];

    public function branch() {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
