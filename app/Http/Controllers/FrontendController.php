<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function contact()
    {    $var="Contact Page";
        return view('contact',['var'=>$var,]);
    }
    function about()
    {    $var="About Page";
        return view('about',['var'=>$var,]);
    }
}
