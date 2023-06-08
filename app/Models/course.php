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
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function units(){
        return $this->hasMany(Unit::class, 'courseId');
    }

    public function student(){
        return $this->belongsToMany(Student::class);
    }
}
