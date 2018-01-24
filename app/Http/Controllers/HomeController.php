<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;
use Form;

class HomeController extends Controller
{
    public function index()
    {
      $words = Word::paginate(15);
      return view('welcome', ["words" => $words]);
    }
}
