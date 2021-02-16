<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
{
    return view('projects.index');
}

    public function show($slug)
    {
        return view('projects.project', ['slug' => $slug]);
    }
}
