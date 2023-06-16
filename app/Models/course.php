<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        // other fillable fields...
    ];
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }


    public function units()
    {
        return $this->hasMany(Unit::class, 'courseId', 'courseId');
    }

    public function student()
    {
        return $this->belongsToMany(Student::class, 'courses_students', 'code', 'ADM')->as('enrollment')->withTimestamps();
    }
}
