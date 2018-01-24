<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Word;
use Response;

class WordController extends Controller
{
    public function addWord(Request $request)
    {
      $word = $request->word;
      $description = $request->description;
      $new_word = Word::create(['word' => $word, 'description' => $description]);
      return Response::json(['word'=> $new_word->word, 'description' => $new_word->description, 'id' => $new_word->id]);
    }

    public function deleteWord(Request $request)
    {
      Word::deleteById($request->id);
      return $request->id;
    }

    public function wordSearch(Request $request)
    {
      $words = Word::findByWordBegin($request->string);
      return Response::json(['words' => $words]);
    }
}
