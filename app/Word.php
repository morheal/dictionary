<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Word;

class Word extends Model
{
    protected $fillable = ['word', 'description'];

    public static function deleteById($id)
    {
        Word::find($id)->delete();
        return;
    }

    public static function findByWordBegin($string)
    {
      if(strlen($string))  $words = Word::where('word', 'like', $string.'%')->get();
      else $words = [];
      return $words;
    }
}
