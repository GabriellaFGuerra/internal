<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlueprintController extends Controller
{
    public function index()
    {
        return view('blueprints.index');
    }

    public function show($slug)
    {
        return view('blueprints.blueprint', ['slug' => $slug]);
    }
}
