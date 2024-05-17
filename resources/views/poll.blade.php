@extends('layout.index')
@section('content')
<html>
    <link rel="stylesheet" href="{{ asset('styles/topics.css') }}">
</html>
<div id="content-outer">
    <div class="center2">
        <div id="addtopic">Dodavanje nove ankete</div>
        <small id="korak1">Korak 1: Unesite glavno pitanje za vašu anketu:</small>
         <form action="{{route('create-poll',['idM'=>(Auth::user()->id),'idT'=>$topic->id])}}" method="post">
            @csrf 
            <div id='insert-topic-form'>
            <div class="labelinput2">
                <label for="name">Pitanje na anketi:</label>
                <input type="text" name="question" id="name">
            </div>
            <div id="btn">
            <button type="submit" id="add-poll"><i class="ri-arrow-right-line"></i> Dalje</button>
            </div>
             </form> 
        </div>
            
       
    </div>
</div>


@endsection

