<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Admin;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'usertype',
        'password',
        'ADM',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'ADM', 'ADM');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'ADM', 'ADM');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'ADM', 'ADM');
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            if ($user->student) {
                $user->student->delete();
            }
            if ($user->teacher) {
                $user->teacher->delete();
            }
            if ($user->admin) {
                $user->admin->delete();
            }
        });
    }
    public function routeNotificationForMail()
    {
        return $this->email;
    }
}
