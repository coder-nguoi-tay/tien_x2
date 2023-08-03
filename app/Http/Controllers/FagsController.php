<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FagsController extends Controller
{
    public function index()
    {
        return view('faqs');
    }
}
