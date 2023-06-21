<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'courseId',
        // other fillable fields...
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseId', 'courseId');
    }
    public function mark()
    {
        return $this->hasOne(Mark::class, 'code', 'code');
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'students_units', 'code', 'ADM');
    }
    public function students_units()
    {
        return $this->hasMany(Students_Units::class, 'code', 'code');
    }
}
