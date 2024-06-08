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
        <p>Broj korisnika: {{$users->count()}}</p>
        <div id="table-div">
            
            @if($users->count() == 0)
                <h2>Nema korisnika.</h2>
            @else
            

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
                                    <td data-label="Izbriši" data-user-id="{{$user->id}}">
                                        <form action="{{route('delete-user-classic',['id'=>$user->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="user-options" type="submit">Izbriši</button>

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
