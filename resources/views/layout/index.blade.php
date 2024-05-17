<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        console.log(loggedInUser.role_id);


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
                    <a class="active" href="{{ route('home') }}" ><i class="ri-home-line"></i> Home</a>
                </li>
                @if(Auth::user() && Auth::user()->role_id == 2)
                <li>
                    <a href="{{route('topics-by-moderator',['idModerator'=>Auth::user()->id])}}" ><i class="ri-message-3-line"></i> Moje teme</a>
                </li>
                @endif
                @if(Auth::user() && Auth::user()->role_id == 3)
                {{-- <li>
                    <a href="/topics" ><i class="ri-message-3-line"></i> Teme</a>
                </li> --}}
                <li>
                    <a href="{{route('my-topics',['idUser'=>Auth::user()->id])}}" ><i class="ri-message-3-line"></i> Teme koje pratim</a>
                </li>
                @endif
                
                @if(Auth::user() && Auth::user()->role_id == 1) 
                    <li class="dropdown">
                        <a id="admin-requests" href="{{route('registrations')}}"><i id="rifill" class="ri-notification-fill"></i> Zahtevi</a>
                        
                    </li>
                @endif
                @guest
                <li>
                    <a href="{{ route('registration') }}" ><i class="ri-login-box-line"></i> Registracija</a>
                </li>
                @else
                <li id="logout">
                    <a href="{{ route('logout') }}" ><i class="ri-logout-box-line"></i> {{Auth::user()->role_id}}Odjavi se</a>
                </li>
                @endguest
                <li>
                    <form action="{{route('search')}}" method="GET">
                    <input name='search' type="text" id="search" placeholder="Pretraga...">
                    <button type="submit" id="search-button"><i class="ri-search-line"></i></button>
                    </form>
                </li>
                @if(Auth::user() && Auth::user()->role_id == 1)
                <li>
                    <a href="/addnews"><span style="color: white;">Pošalji vest</span></a>
                </li>
                @else
                <li>
                    <a href="/news"><span id="n" style="color: white;">Vesti</span></a>

                </li>
                @endif               
                
                
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
    

        document.getElementById('menu-toggle').addEventListener('click', function() {
    
    document.querySelector('.nav-bar').classList.toggle('active');
        });
    </script>
</body>
</html>