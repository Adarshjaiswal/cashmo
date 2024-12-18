<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AEPSController extends Controller
{
    //
    public function index(){
        return view('aeps.index');
    }

    /// balanceinfo page
    public function balanceinfo(){
        return view('aeps.balanceinfo');
    }

    // ministatement page
    public function ministatement(){
        return view('aeps.ministatement');
    }

    /// withdrawal from
    public function withdrawal(){
        return view('aeps.withdrawal');
    }

    // ATMwithdrawal page
    public function atmwithdrawal(){
        return view('aeps.atmwithdrawal');
    }
}
