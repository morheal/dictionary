@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h1>Електронний словник українських термінів лісівництва</h1>
                </div>

                <div class="panel-body">
                    <form class="word_search" action="#" method="post">
                      <input type="text" name="word_search" placeholder="">
                      <input type="submit" name="" value="Знайти слово">
                    </form>
                </div>

                <div class="panel-body words">
                    @foreach($words as $word)
                        <div class="word">
                            <h3>{{$word->word}}</h3>
                            <p>{{$word->description}}</p>
                        </div>
                    @endforeach
                    {{$words->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
@include('includes.standarts')
@endsection
