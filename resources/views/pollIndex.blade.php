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
            <br>
            <h1>Anketa za temu:</h1> 
            <h1 id="nametopic">{{$poll->topic->name}}</h1>

            <br>
            <br>
            @if(Auth::user()->role_id==3)
            <form action="{{route('vote')}}" method="POST">
                @csrf
            @else
            <form action="{{route('delete-poll',['id'=>$poll->id])}}" method="POST">
            @csrf
            @method('DELETE')
                @endif
            <h4>Pitanje: {{$poll->question}}</h4>
            @forelse($poll->answers as $a)
            <div id="one-request">
                <div class="one-request-item" id="mail2">
                    <p>{{$a->content}}</p>
                </div>
                @if(Auth::user()->role_id == 2)
                <div class="one-request-item" id="mail2">
                    <p> 
                        <span><i class="ri-group-fill"></i> </span>
                        <span>{{$a->votes}}</span>
                    </p>
                </div>
                @else
                <div class="one-request-item" id="mail2">
                    <p> 
                        <span><input type="radio" name="ans" value="{{$a->id}}"></span>
                        <span><i class="ri-group-fill"></i> {{$a->votes}}</span>

                    </p>
                </div>
                @endif
                
            </div>
            @empty
            <p>Nema odgovora.</p>
            @endforelse
        </div>
        <div id="inner5-button">
            @if(Auth::user()->role_id==2)
        <button type="submit">Izbrisi anketu</button>
        @else
        <button id="b" type="submit" style="background-color:#1c4966; " >Pošalji odgovor</button>
        @endif
        </form>
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