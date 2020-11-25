<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoveController extends Controller
{
    public function layout(Type $var = null)
    {
        return view('layout');
    }
}
