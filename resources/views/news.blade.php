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
            <h1>Obaveštenja na forumu </h1>

            <table id="admin-messagess">
                <tr>
                    <th>Vest:</th>
                    <th>Poslato od:</th>
                    <th>Vreme:</th>
                </tr>
                @foreach ($news as $n)

                <tr>
                    <td>{{$n->content}}</td>
                    <td>{{$n->owner}}</td>
                    <td>{{$n->created_at}}</td>
                </tr>
                @endforeach

            </table>
            @if(Auth::user() && Auth::user()->role_id == 3)
            <h1>Obaveštenja od moderatora tema koje pratite </h1>

            <table id="admin-messagess">
                <tr>
                    <th>Vest:</th>
                    <th>Poslato od:</th>
                    <th>Tema:</th>
                    <th>Vreme:</th>
                </tr>
                @foreach ($news2 as $n2)
                @if(Auth::user()->following()->get()->contains($n2->topic_id))
                <tr>
                    <td>{{$n2->content}}</td>
                    <td>{{$n2->owner}}</td>
                    <td>{{$topics->find($n2->topic_id)->name}}</td>
                    <td>{{$n2->created_at}}</td>
                </tr>
                @endif
                @endforeach

            </table>
            @endif
            @if(Auth::user() && Auth::user()->role_id == 2)
            <h1>Novi pratioci </h1>

            <table id="admin-messagess">

                @foreach ($followers as $f)
                @if($f->idM == Auth::user()->id)
                <tr>
                    <td>{{$f->content}}</td>
                    <td>{{$f->created_at}}</td>
                </tr>
                @endif
                @endforeach

            </table>
            @endif

           {{--  <div id="flexx">
                @foreach ($news as $n)
                <p>Vest:</p>
                <h6>{{$n->content}}</h6>
                <br>
                <p>Poslato od:</p>
                <h6>{{$n->owner}}</h6>
                <p>Vreme:</p>
                <h6>{{$n->created_at}}</h6>
            </div>
            
                
            @endforeach --}}
    
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

