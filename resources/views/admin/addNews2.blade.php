@extends('layout.index')
@section('content')
<html>
    <link rel="stylesheet" href="{{ asset('styles/topics.css') }}">
</html>
<div id="content-outer">
    <div class="center2">

        <div id="addtopic">Pošaljite obaveštenje svim pratiocima vaše teme</div>
        <form action="{{route('add-news2',['id'=>$t])}}" method="post"  enctype="multipart/form-data">
        @csrf
            <div id='insert-topic-form'>
            <div class="labelinput2">
                
                <label for="name2">Sadrzaj poruke</label>
                <textarea type="text" name="name" id="name" rows="3">
                </textarea>
            </div>
            
            <button type="submit" id="add-topic"><i class="ri-add-line"></i> Pošalji</button>
        </form>
        </div>
            
       
    </div>
</div>


@endsection

