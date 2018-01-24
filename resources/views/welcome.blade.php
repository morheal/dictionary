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
                      <input type="text" name="word_search" id="word_search" placeholder="Введіть шукане слово">
                    </form>
                </div>
                @guest
                @else
                <div class="panel-body">
                  <form class="add_word" action="#" method="post">
                    {{csrf_field()}}
                    <input type="text" name="word" placeholder="Напишіть слово" id="word">
                    <input type="text" name="description" placeholder="Напишіть опис слова" id="description">
                    <input type="submit" name="" value="Добавить слово">
                  </form>
                </div>
                @endguest
                <div class="panel-body words">
                    @foreach($words as $word)
                        <div class="word">
                            <h3>{{$word->word}}</h3>
                            <p>{{$word->description}}</p>
                            @guest
                            @else
                            <input type='hidden' name='word_id' class='word_id' value='{{$word->id}}'>
                            <p><a href="#" class="delete_word">Видалити слово</a></p>
                            @endguest
                        </div>
                    @endforeach
                    {{$words->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
@include('includes.standarts')
<script type="text/javascript">
  //ajax for adding word
  $(document).on("submit", ".add_word", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/add_word",
        dataType: 'json',
        data: { word: $(".add_word #word").val(), description: $(".add_word #description").val() },
        //adding new word block if ajax was success
        success: function(success) {
          if(!$(".just_added").length) {
            $(".add_word").after("<div class='panel-body just_added'><h3>Тільки що додані слова</h3></div>");
          }
          $(".just_added").append("<div class='word'><h3>"+success.word+'</h3><p>'+success.description+"</p><input type='hidden' name='word_id' class='word_id' value='"+success.id+"'><p><a class='delete_word' href='#'>Видалити слово</a></p></div>");
        }
      });
  });

  //ajax for deleting words
  $(document).on("click", ".delete_word", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/delete_word",
        dataType: 'json',
        data: { id: $(this).parent().parent().find(".word_id").val() },
        //adding new word block if ajax was success
        success: function(success) {
          $("input[value='" + success + "']").parent().remove();
          console.log($(".just_added .word").length);
          if($(".just_added .word").length == 0) $(".just_added").remove();
        }
      });
  });

  $(document).on("keyup", "#word_search", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/word_search",
        dataType: 'json',
        data: { string: $(this).val() },
        //adding new word block if ajax was success
        success: function(success) {
          console.log(success);
          if(typeof success.words !== 'undefined' && success.words.length > 0) {
            if($(".finded_words").length) {
              $(".finded_words").remove();
            }
            $(".word_search").after("<div class='panel-body finded_words'><h3>Знайдені слова</h3></div>");
            success.words.forEach(function(word) {
              $(".finded_words").append('<div class="finded_word"><h3>'+word.word+'</h3><p>'+word.description+'</p></div>');
            })
          }
          else if($(".finded_words").length) {
            $(".finded_words").remove();
          }
        }
      });
  });
</script>
@endsection
