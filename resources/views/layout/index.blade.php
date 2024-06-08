<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/index.css') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>Homepage</title>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>
        var loggedInUser = {!! auth()->check() ? json_encode(auth()->user()) : 'null' !!};
        console.log(loggedInUser.id);


        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
    
        var pusher = new Pusher('29c51e7c4449189ae1cb', {
          cluster: 'ap1'
        });
        
        var channel = pusher.subscribe('admin-message');

        if(loggedInUser.role_id == 1){
        //sta se dogadja kad se desi dogadjaj
          channel.bind('user-register', function(data) {
            document.getElementById('admin-requests').style.color = 'green';
            document.getElementById('rifill').style.display = 'inline';
          //alert(JSON.stringify(data));
        }); 
    }
    //else if(loggedInUser.role_id == 3) {
        channel.bind('message-from-admin', function(data) {
            alert(data.message);
            console.log(data);
            document.getElementById("n").style.color = "red";
      });
      if(loggedInUser.role_id == 3){
      //alert(loggedInUser.role_id)
        channel.bind('message-from-moderator'+loggedInUser.id, function(data) {
            alert(data.message);
           // console.log(data);
            document.getElementById("n").style.color = "red";
      });
    }
     //if(loggedInUser.role_id == 2){
          if(loggedInUser.role_id==2){
        channel.bind('topic-accept'+loggedInUser.id, function(data) {
            document.getElementById("n").style.color = "green";
            document.getElementById("n").style.fontWeight = "bold";
            alert(data.mess);
            
      }); 
      } 
      channel.bind('new-follower'+loggedInUser.id, function(data) {
            alert(data.mess);
           // console.log(data);
            //document.getElementById("n").style.color = "red";
      });
    
     
      
    //}
      </script>
</head>
<body>
    <header>
        <a href='{{route("home")}}' style="cursor: pointer;"><div class='logo'></div></a>
        <div class='menu-lines' id="menu-toggle">
            <div class='line'></div>
            <div class='line'></div>
            <div class='line'></div>
        </div>
        <nav class='nav-bar'>
            <ul>
                <li>
                    <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" ><i class="ri-home-line"></i> Home</a>
                </li>
                @if(Auth::user() && Auth::user()->role_id == 2)
                <li>
                    <a class="{{ request()->routeIs('topics-by-moderator') ? 'active' : '' }}" href="{{route('topics-by-moderator',['idModerator'=>Auth::user()->id])}}" ><i class="ri-message-3-line"></i> Moje teme</a>
                </li>
                @endif
                @if(Auth::user() && Auth::user()->role_id == 3)
                {{-- <li>
                    <a href="/topics" ><i class="ri-message-3-line"></i> Teme</a>
                </li> --}}
                <li>
                    <a class="{{ request()->routeIs('my-topics') ? 'active' : '' }}" href="{{route('my-topics',['idUser'=>Auth::user()->id])}}" ><i class="ri-message-3-line"></i> Teme koje pratim</a>
                </li>
                @endif
                @if(Auth::user() && Auth::user()->role_id == 1)
                {{-- <li>
                    <a href="/topics" ><i class="ri-message-3-line"></i> Teme</a>
                </li> --}}
                <li>
                    <a class="{{ request()->routeIs('topics') ? 'active' : '' }}" href="/topics"><i class="ri-message-3-line"></i> Sve teme</a>
                </li>
                @endif
                
                @if(Auth::user() && Auth::user()->role_id == 1) 
                    <li class="dropdown">
                        <a class="{{ request()->routeIs('registrations') ? 'active' : '' }}" id="admin-requests" href="{{route('registrations')}}"><i id="rifill" class="ri-notification-fill"></i> Zahtevi</a>
                        
                    </li>
                @endif
               
                @if(Auth::user() && Auth::user()->role_id == 1)
                <li>
                    <a  id="news" href="/addnews"><span style="color: white;">Pošalji vest</span></a>
                </li>
                @else
                    @if(Auth::user())
                    <li>
                        <a id="news" href="/news"><span id="n" style="color: white;"><i class="ri-file-list-3-line"></i> Vesti</span></a>

                    </li>
                    @endif
                @endif  
                @guest
                <li>
                    <a class="{{ request()->routeIs('registration') ? 'active' : '' }}" href="{{ route('registration') }}" ><i class="ri-login-box-line"></i> Registracija</a>
                </li>
                @else
                <li id="logout">
                    <a href="{{ route('logout') }}" ><i class="ri-logout-box-line"></i> Odjavi se</a>
                </li>
                @endguest
                
                             
                
                
            </ul>
        </nav>
        
    </header>
    <div class='content'>
        <div class="message-container">
            <div class="message">
                <p>Vasa poruka.</p>
            </div>
        </div>
        @yield('content')
    </div>
    
    <script {{-- src="{{ asset('javascript/index.js') }}" --}}>
    

    // Pronađi sve linkove unutar navigacije
var aa = document.querySelectorAll('.nav-bar ul li a');

// Prođi kroz sve linkove i dodaj event listener za klik
aa.forEach(element => {
    element.addEventListener("click", (e) => {
        // Spreči podrazumevanu akciju linka
        e.preventDefault();

        // Ukloni aktivnu klasu sa svih linkova
        aa.forEach(link => link.classList.remove('active'));

        // Dodaj aktivnu klasu na kliknuti link
        element.classList.add('active');
        
        // Izvrši navigaciju na ciljnu stranicu
        window.location.href = element.href;
    });
});

// Dodaj event listener za meni toggle dugme
document.getElementById('menu-toggle').addEventListener('click', function() {
    document.querySelector('.nav-bar').classList.toggle('active');
});

        document.getElementById('menu-toggle').addEventListener('click', function() {
    
    document.querySelector('.nav-bar').classList.toggle('active');
        });
    </script>
</body>
</html>