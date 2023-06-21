<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mark extends Model
{
    use HasFactory;

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class, 'code', 'code');
    }
}
