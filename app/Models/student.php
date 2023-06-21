<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'user_id',
        'ADM',

        // other fillable fields...
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ADM', 'ADM');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'courses_students', 'ADM', 'code');
    }
    public function courses_students()
    {
        return $this->hasMany(Courses_Students::class, 'ADM', 'ADM');
    }
    public function units()
    {
        return $this->belongsToMany(Unit::class, 'students_units', 'ADM', 'code');
    }
    public function students_units()
    {
        return $this->hasMany(Students_Units::class, 'ADM', 'ADM');
    }
    public function mark()
    {
        return $this->hasMany(Mark::class);
    }
}
