<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courses_students extends Model
{
    use HasFactory;

    public function course(){
        return $this->belongsTo(course::class,'code');
    }
}
