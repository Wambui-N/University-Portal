<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courses_students extends Model
{
    protected $table = 'courses_students';
    public $timestamps = false;

    public function course(){
        return $this->belongsTo(course::class,'code');
    }

    public function student(){
        return $this->belongsTo(student::class,'ADM');
    }
}
