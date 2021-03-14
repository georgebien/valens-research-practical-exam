<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function new_paint_jobs_page()
    {
        return view('new_paint_jobs');
    }
    
    public function paint_jobs_page()
    {
        return view('paint_jobs');
    }
}
