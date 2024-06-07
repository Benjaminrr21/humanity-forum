@extends('layout.index')
@section('content')
<html>
    <link rel="stylesheet" href="{{ asset('styles/topics.css') }}">
</html>
<div id="content-outer">
    <div class="center2">
        <div id="addtopic">Kreirajte temu</div>
        
        @if($message = Session::get('message'))
        <span id="incorrect-span">{{$message}}</span>
        @endif
        <form action="{{route('add-topic-create',['id'=>(Auth::user()->id)])}}" method="post"  enctype="multipart/form-data">
        @csrf
            <div id='insert-topic-form'>
            <div class="labelinput2">
                <label for="name">Naziv teme</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="labelinput2">
                <label for="description">Opis teme</label>
                <textarea rows="3" cols="10" id="desc" name="content"></textarea>
                
                <label for="material" id='label-photo'><i style="color: white;" class="ri-file-line"></i> Dodaj fajl uz opis (opciono)
                    <input  id="material" type='file' placeholder='Fajl...' name='file'></input>
                    </label>

                {{-- <button id="add-material" type="button"><label for="file"><i class="ri-file-add-line"></i> Dodaj fajl uz opis</label></button>
                <input type="file" name="file" id='material'> --}}
            </div>
            <button type="submit" id="add-topic"><i class="ri-add-line"></i> Kreiraj temu</button>
        </form>
        </div>
            
       
    </div>
</div>


@endsection

