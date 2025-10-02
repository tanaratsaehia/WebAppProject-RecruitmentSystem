<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOpening;

class HomeController extends Controller
{
    public function index(){
        $all_job_opening = JobOpening::all();
        return view("home", compact("all_job_opening"));
    }
}
