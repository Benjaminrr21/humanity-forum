@extends('layout.index')
@section('content')
<html>
    <link rel="stylesheet" href="{{ asset('styles/topics.css') }}">
</html>
<div id="content-outer">
    <div class="center2">
        <div id="addtopic">Pošaljite opštu vest svim korisnicima foruma</div>
        <form action="{{route('add-news')}}" method="post"  enctype="multipart/form-data">
        @csrf
            <div id='insert-topic-form'>
            <div class="labelinput2">
                <label for="name">Vest</label>
                <input type="text" name="name" id="name">
            </div>
            
            <button type="submit" id="add-topic"><i class="ri-add-line"></i> Pošalji</button>
        </form>
        </div>
            
       
    </div>
</div>


@endsection

