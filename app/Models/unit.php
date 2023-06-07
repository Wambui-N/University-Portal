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
        // other fillable fields...
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
