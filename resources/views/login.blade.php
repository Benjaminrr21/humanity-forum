
<html>
  <head>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
    
        var pusher = new Pusher('29c51e7c4449189ae1cb', {
          cluster: 'ap1'
        });
        
        var channel = pusher.subscribe('admin-message');

        //sta se dogadja kad se desi dogadjaj
        /* channel.bind('user-register', function(data) {
            document.getElementById('admin-requests').style.color = 'green';
            document.getElementById('rifill').style.display = 'inline';
          //alert(JSON.stringify(data));
        }); */
        channel.bind('messageUser', function(data) {
        alert('Zahtev je prihvacen.');
        console.log("Prihvaceno..");
        console.log(data);
      });
      </script> 
  </head>  
</html>
@extends('layout.index')
@section('content')
    <div id='reg-container'>
        <div id='reg-container-inner'>
        @if ($find = Session::get('find'))
            <p>{{$find}}</p>
        @endif
            <h1>Prijava</h1>
            {{-- @if ($msg = Session::get('msg')) --}}
        @if (!($find = Session::get('find')))

            <h4>Korisničko ime Vam je poslato na mejl adresu.</h4>
        @endif
            {{--  @endif --}}
            <div id='form'>
                <form action="{{ route('login_user') }}" method='post'>
                    @csrf

                    <div class='labelinput'>
                        <i class="ri-map-pin-user-line"></i>
                        <input type='text'placeholder='Korisničko ime' id='username' name='username'></input>
                        
                    </div>

                    <div class='labelinput'>
                        <i class="ri-lock-line"></i>
                        <input type='password'placeholder='Lozinka' name='password'></input>
                        @error('password')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    

                    <button type='submit'>Prijavi se</button>
                </form>
            </div>
        </div>
    </div>
@endsection
