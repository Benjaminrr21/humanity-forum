<html>
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
        <p>Broj pratioca: {{$users->count()}}</p>
        <div id="table-div">
            <div id="seriously">
                Da li ste sigurni da želite udaljiti korisnika?
                <button class="acc" id="acc" onclick="deleteUser(this)">Da</button>
                <button class="acc" onclick="hide()">Ne</button>
            </div>
            @if($users->count() == 0)
                <h2>Nemate pratioca</h2>
            @else
            <div id="bu" >
                <span id="user-options" style="background-color: rgb(86, 134, 86); padding:0.3rem; margin:0 1rem 3rem 0; color:white;">
                    Nepoželjni korisnik je:
                </span>
                @if($baduser && $baduser->id == Session::get('baduser_id'))
                    <span>{{$baduser->username}}</span>
                    <a href="{{route('alert',['id'=>$baduser->email])}}"><button id="user-options2">Upozori</button></a>
                @else
                    <span>Nema nepoželjnih korisnika.</span>
                @endif
            </div>

                <div class="table-responsive">
                    <table id="tbl">
                        <thead>
                            <tr>
                                <th>Ime</th>
                                <th>Prezime</th>
                                <th>Email</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td data-label="Ime">{{$user->firstname}}</td>
                                    <td data-label="Prezime">{{$user->lastname}}</td>
                                    <td data-label="Email">{{$user->email}}</td>
                                    <td data-label="Udalji sa teme" data-user-id="{{$user->id}}" data-topic-id="{{$topic->id}}">
                                        <button class="user-options" onclick="display(this)">Udalji sa teme</button>
                                    </td>
                                    <td data-label="Udalji sa svih mojih tema">
                                       <form method="POST" action="{{route('delete-user-all',['idUser'=>$user->id,'idModerator'=>Auth::user()->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="user-options" type="submit">Udalji sa svih mojih tema</button>
                                       </form> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<script src='{{asset("javascript/users.js")}}'></script>
@endsection
