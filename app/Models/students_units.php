<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students_units extends Model
{
    protected $table = 'students_units';
    public $timestamps = false;

    public function unit(){
        return $this->belongsTo(unit::class,'code');
    }

    public function student(){
        return $this->belongsTo(student::class,'ADM');
    }
}
