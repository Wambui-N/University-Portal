<?php
namespace App\Helpers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;

class UserHelper
{
    public static function createUser($usertype, $ADM)
    {
        switch ($usertype) {
            case 'student':
                Student::create([
                    'ADM' => $ADM,
                    //'additional_column' => 'value', // Add any additional columns specific to the student table
                ]);
                break;
            case 'teacher':
                Teacher::create([
                    'ADM' => $ADM,
                    //'additional_column' => 'value', // Add any additional columns specific to the teacher table
                ]);
                break;
            case 'admin':
                Admin::create([
                    'ADM' => $ADM,
                    //'additional_column' => 'value', // Add any additional columns specific to the admin table
                ]);
                break;
            default:
                // Handle invalid user type
                break;
        }
    }
}
