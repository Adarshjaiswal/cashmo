<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BBPSController extends Controller
{
    //Index page
    public function index(){
        return view('bbps.index');
    }
}
