<html>
    <head>
        <link rel="stylesheet" href="{{asset('styles/registrations.css')}}">
    </head>
</html>
@extends('layout.index')
@section('content')
    <div id="outerr5">
        <div id="mainn5">

        <div id='innerr5'>
            <h1>Statistika za temu </h1>
            <h1 id="imeteme">{{$topic->name}}</h1>
            
<p><i style="color: #1c4966;" class="ri-user-voice-line"></i> Broj pratioca: {{$topic->followers->count()}}</p>
<p><i class="ri-calendar-schedule-line"></i> Datum kreiranja: {{$topic->created_at}}</p>

<p><i class="ri-timer-2-line"></i> Duzina trajanja teme na forumu: {{$time}}</p>

<p><i class="ri-chat-thread-line"></i> Prosecan broj tema u odnosu na sve teme: {{$ta}}%</p>
<p><i class="ri-user-voice-line"></i> Prosecan broj pratioca u odnosu na sve korisnike foruma: {{$ta}}%</p>
        </div>
        
    </div> 


    </div>
    <script src="{{asset('javascript/registrations.js')}}"></script>
@endsection

{{-- 
@forelse($user->notifications as $notif)
    <p>{{$notif->data['email']}}</p>
    

    
@empty
    <p>Nema zahteva za registraciju.</p>
@endforelse --}}

{{-- <html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <style>
        p,h1 {
            background-color: white;
            color: black;

        }
    </style>
    <link rel="stylesheet" href="{{asset('styles/users.css')}}">


</html>

@extends('layout.index')
@section('content')
<div id="content-outer-users">
    <div id="inner">
    <h3 id="req">Zahtevi za registraciju</h3>
    @if(!($message = Session::get('users')))
    <p>Nema novih zahteva.</p>
    @else

    <div id="table-div">
        <div id="seriously3" >Da li ste sigurni da želite odbiti registraciju korisnika? 
            <button class="acc" id="acc" onclick="deleteRequest(this)">Da</button>
            <button class="acc" onclick="hide()">Ne</button>
        </div>
        
    <table id="tbl">
        <tbody>
            <tr>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Email</th>
    
            </tr>
            @foreach ($users as $user)
            <tr >
                <td>{{$user->firstname}}</td>
                <td>{{$user->lastname}}</td>
                <td>{{$user->email}}</td>
                <td data-user-id={{$user->id}}><button class="user-options" onclick="display(this)">Odbij zahtev</button></td>
                
        @endforeach
    
        </tbody>
    </table>
@endif
</div>
</div>
</div>

<script src='{{asset("javascript/requests.js")}}'></script>


@endsection
 --}}

{{-- <h2>Id ankete: {{$poll->id}}</h2>
<h2>Pitanje: {{$poll->question}}</h2>

<h4>Odgovori:</h4>
<h5>{{$poll->answers->count()}}</h5>
@foreach ($poll->answers as $item)
    <h5>{{$item->content}}</h5>
@endforeach --}}

