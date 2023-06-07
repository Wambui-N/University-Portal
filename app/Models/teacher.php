<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teacher extends Model
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
    return $this->belongsTo(User::class);
}

    public function course(){
        return $this->hasMany(Course::class);
    }
}
