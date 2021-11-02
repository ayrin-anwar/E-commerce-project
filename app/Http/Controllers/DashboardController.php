<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard(){
        
        if(auth()->user()->roles->first()->name=='customer')
        {
            return view('backend.customerdashboard');
        }
        else{
            return view('backend.dashboard');
        }
       
    }
}
