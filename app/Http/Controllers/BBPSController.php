<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BBPSController extends Controller
{
    //Index page
    public function index(){
        return view('bbps.index');
    }

    /// electricity controller
    public function electricity(){
        return view('bbps.electricity');
    }

    //Gas Bill
    public function gasBill(){
        return view('bbps.gas');
    }


    // water bill
    public function waterBill(){
        return view('bbps.water');
    }

    // broadbandBill
    public function broadbandBill(){
        return view('bbps.broadband');
    }

    /// landlineBill 
    public function landlineBill(){
        return view('bbps.landline');
    }

    ///taxMuncipal
    public function taxMuncipal(){
        return view('bbps.taxMuncipal');
    }

    //digitalVoucher
    public function digitalVoucher(){
        return view('bbps.digital_voucher');
    }

    //insurance
    public function insurance(){
        return view('bbps.insurance');
    }

    /// loanRepayment
    public function loanRepayment(){
        return view('bbps.loan_repayment');
    }
}
