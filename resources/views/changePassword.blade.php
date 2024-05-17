<html>
    <link rel="stylesheet" href="{{ asset('styles/registration.css') }}">
</html>
@extends('layout.index')
@section('content')
<div id='reg-container'>
    <div id='reg-container-inner'>
        @if (!($message = Session::get('find')))
            @if (($message2 = Session::get('not-found')))
            <p id="msg2">{{$message2}}</p>
            @endif

        <h1>Unesite email adresu za potvrdu</h1>
        <div id='form'>
   
                <form action="{{ route('check-email') }}" method="GET">
                    @csrf
                    <div class='labelinput'>
                        <i class='bx bx-envelope' ></i>
                        <input id="p11" type='email' placeholder='Email' name='email'>
                    </div>
                    <button type='submit'>Proveri</button>
                </form>
            @else
            <p>{{$message}}</p>
            <h1>Promena lozinke</h1>
            <div id='form'>
                <form  action="{{route('changeP',['id'=>$message])}}" method="POST">
                    @csrf
                    <div><small style="text-align: center;">Lozinka mora sadržati mala slova, brojeve i jedan specijalan znak.</small></div>
                    <div class='labelinput'>
                        <i class="ri-lock-line"></i>
                        <input id="p1" type='password' placeholder='Nova lozinka' name='password'>
                    </div>
                    <div id="progress">
                        <div style="visibility: hidden;" id="progress-bar"></div>
                    </div>

                    <div class='labelinput'>
                        <i class="ri-lock-line"></i>
                        <input id="p2" type='password' placeholder='Ponovite novu lozinku' name='newPassword'>
                    </div>
                    <div id="match">
                        <div style="display: none;" id="match-text"></div>
                    </div>
                    <button type='submit'>Promeni</button>
                </form> 
            @endif
        </div>
    </div>
</div>
@endsection
<script src="{{ asset('javascript/change-password.js') }}"></script>
