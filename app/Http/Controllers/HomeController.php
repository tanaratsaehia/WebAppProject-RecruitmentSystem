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

    public function indexWithOutLogin() {
        $all_job_opening = JobOpening::all();
        return view('home-with-out-login', compact("all_job_opening"));
    }
}
