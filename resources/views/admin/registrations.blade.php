<html>
    <head>
        <link rel="stylesheet" href="{{asset('styles/registrations.css')}}">
    </head>
</html>
@extends('layout.index')
@section('content')
    <div id="outerr">
        
        <div id='innerr2'>
            @if($success = Session::get("success"))
            <h2>{{$success}}</h2>
            @endif
            <h2>Zahtevi za registraciju</h2>
            @forelse($requests as $r)
            <div id="one-request">
                <div class="one-request-item" id="mail"><p>{{$r->firstname}}</p></div>
                <div class="one-request-item" id="mail"><p>{{$r->lastname}}</p></div>
                <div class="one-request-item" id="mail"><p>{{$r->email}}</p></div>
                <div class="one-request-item">
                    <form action="{{ route('acceptuser', $r->id) }}" method="post">
                        @csrf
                        <button id="accept" type="submit" class="btn btn-danger btn-sm" id="decline">Odobri</button>
                      </form>
                </div>
                <div class="one-request-item">
                    <form action="{{ route('deleteuser', $r->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" id="decline">Delete</button>
                      </form>
                </div>
            </div>
            @empty
            <p>Nema zahteva za registraciju.</p>
            @endforelse
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