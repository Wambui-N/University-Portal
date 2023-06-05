<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class AdminViewController extends Controller
{
    public function display($slug)
    {
        $view = null;

        $path = resource_path("views/admin/assets/{$slug}.blade.php");

        if (file_exists($path)) {
            $view = view("admin/assets/{$slug}");
        }

        return view('admin/dashboard', compact('view'));
    }
}
