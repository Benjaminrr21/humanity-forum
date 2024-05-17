@extends('layout.index')
@section('content')
<html>
    <link rel="stylesheet" href="{{ asset('styles/topics.css') }}">
</html>
<div id="content-outer">
    <div class="center2">
        <div id="addtopic">Dodavanje nove ankete</div>
        <p>Korak 1: Unesite glavno pitanje za vašu anketu:</p>
        <form action="{{route('add-poll',['idM'=>(Auth::user()->id),'idT'=>$topic])}}" method="post">
        @csrf
            <div id='insert-topic-form'>
            <div class="labelinput2">
                <label for="name">Pitanje na anketi:</label>
                <input type="text" name="content" id="name">
            </div>
            
            <button type="submit" id="add-poll"><i class="ri-add-line"></i> Dalje</button>
        </form>
        </div>
            
       
    </div>
</div>


@endsection

