<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoveController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }

    public function layout(Request $request)
    {
        return view('layout');
    }
    
    public function showUsers(Request $request)
    {
        return view('user_list');
    }

    public function modifyUser(Request $request,$id)
    {
        
    }

}
