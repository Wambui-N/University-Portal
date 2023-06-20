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


    public function mark()
    {
        return $this->hasMany(Mark::class);
    }
}
