@extends('layout.index')
@section('content')
<div id='homepage-container'>
    <div class='heading'>
        <div id='heading-inner'>
            <h1>Neka tvoja humanost bude primećena.</h1>
            <p>Mesto gde humanitarnost i saosećanje sa drugima izlazi na videlo.</p>
            
        </div>
    </div>
    @guest
    <div id='heading2'>
    <div id='reg-container2'>
        <div id='reg-container-inner2'>
            <div class="titlee">
                <div id="logoimg"></div>
                <div id="hh"><h1>Prijava</h1></div>
            </div>
            @if($message = Session::get('message'))
            <div id="incorrect">
                {{$message}}
            </div>
            @endif
            <div id='form'>
              
                <form action="{{ route('login_user') }}" method='post'>
                    @csrf

                    <div class='labelinput'>
                        <i class="ri-map-pin-user-line"></i>
                        <input type='text'placeholder='Korisničko ime' id='username' name='username'></input>
                        
                    </div>

                    <div class='labelinput'>
                        <i class="ri-lock-line"></i>
                        <input type='password'placeholder='Lozinka' name='password' autocomplete="new-password"></input>
                        
                    </div>
                    <a href="{{route('change-password')}}" style="color: #1c4966; margin-left:1.7rem;">Zaboravio/la si sifru ?</a>

                    <div id="loading">
                        <div class="lds-ring"><div></div><div></div><div></div><div>
                               
                        </div></div>
                        <div><p><i>Prijavljivanje u toku...</i></p></div> 
                    </div>
                    <button id="log" onclick="see()" type='submit'><i class="ri-login-circle-line"></i> Prijavi se</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    @endguest
    @if(Auth::user() )
    @if(Auth::check() && (Auth::user()->role_id == 1 || Auth::user()->role_id==3))
    <div id='heading2'>
        <div id='reg-container2'>
            <div id='reg-container-inner2' style="padding: 5rem; padding-top:8rem; background-color:transparent;">
                <a href="/topics"><button id="view-topics">Pogledaj sve teme</button></a>
            </div>
        </div>
    </div>
    @endif
    @if(Auth::check() && Auth::user()->role_id == 2 )
    <div id='heading2'>
        <div id='reg-container2'>
            <div id='reg-container-inner2' style="padding: 5rem; padding-top:8rem; background-color:transparent;">
                <a href="/add-topic"><button id="view-topics"><i style="color:#1c4966;" class="ri-links-line"></i>Dodaj novu temu</button></a>
            </div>
        </div>
    </div>
    @endif
    @endif

</div>

@endsection
<script src="javascript/index.js">

</script>