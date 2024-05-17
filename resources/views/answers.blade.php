@extends('layout.index')
@section('content')
<html>
    <link rel="stylesheet" href="{{ asset('styles/topics.css') }}">
</html>
<div id="content-outer">
    <div class="center2">
        <div id="addtopic">Odgovori na anketu</div>
        <small id="korak1">Korak 2: Unesite odgovore za vašu anketu:</small>
         <form action="{{route('add-answers',['id'=>$poll->id])}}" method="post">
            @csrf 
            <div id='insert-topic-form'>
                <p>{{$poll->id}}</p>
                <p>Pitanje: {{$poll->question}}</p>
            <div class="labelinput2">
                <label for="name">Odgovori:</label>
                <input placeholder="Odgovor 1" type="text" name="answer1" id="name">
                <input placeholder="Odgovor 2" type="text" name="answer2" id="name">
                <input placeholder="Odgovor 3" type="text" name="answer3" id="name">
            </div>
            <div id="btn">
            <button type="submit" id="add-poll"><i class="ri-arrow-right-line"></i> Kraj</button>
            </div>
             </form> 
        </div>
            
       
    </div>
</div>


@endsection

