<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = Word::paginate(15);
        return view('welcome', ['words' => $words]);
    }

}
