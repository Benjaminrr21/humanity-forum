<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('29c51e7c4449189ae1cb', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('admin-message');

        channel.bind('messageUser', function(data) {
            alert('Zahtev je prihvacen.');
            console.log("Prihvaceno..");
            console.log(data);
        });
    </script> 
    <style>
        #code-btn {
            background-color: #1c4966;
            color: white;
            padding: 0.7rem;
            text-align: center;
            border-radius: 10px;
        }
    </style>
</head>
<body>
@extends('layout.index')
@section('content')
    <div id='reg-containerr' >
        <div id='reg-container-inner' style="display: flex; justify-content:center; flex-direction:column;">
            <div><h1>Kod je poslat na mejl adresu. <br> Preostalo vreme: <div id="demo"></div></h1></div>
            <div>
            <h3 style="text-align: center;">Unesite kod: 
                <input style="padding: 0.5rem;" type="text" id="code-in">
                <button id="code-btn" onclick="checkCode()">Pošalji kod</button>
                <div id="load" class="lds-ring" style="display: none;"><div></div><div></div><div></div><div></div></div>
                
            </h3>
            </div>
        </div>
        
        
    </div>
    <script>
       

        var countDownDate = new Date().getTime() + 5 * 60 * 1000;

        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "Vreme je isteklo";
            }
        }, 1000);

        var serverCode = "{{ $code }}";
        var userId = "{{ $user->id }}"

        alert(userId)
        console.log(serverCode);

       

function sendRequestFromJS2(method,route){
  console.log(route);
  var xhr = new XMLHttpRequest();
  //xhr.open("POST",`/like-comment/${commentId}`,true);
  xhr.open(method,route,true);
  xhr.setRequestHeader("Content-Type","application/json");
  xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));


  xhr.onload = function () {
      if (xhr.status === 200) {
          // Obrada uspešnog odgovora od servera
          var response = JSON.parse(xhr.responseText);
          console.log("Komentar lajkovan. Novi broj lajkova: " + response.likesCount);
          // Možete ažurirati UI da prikažete novi broj lajkova
      } else {
          // Obrada greške
          console.error("Došlo je do greške prilikom lajkovanja komentara.");
      }
  };
  
  // Pripremamo podatke koje ćemo poslati
  var data = JSON.stringify({
      // Možete poslati dodatne informacije ako je potrebno
  });
  
  // Šaljemo zahtev
  xhr.send(data);

 
}
function accept(){
    sendRequestFromJS2("POST",`/acceptuser/${userId}`);
}
function deleteUser(){
    sendRequestFromJS2("DELETE",`/deleteuser/${userId}`);
}
function checkCode() {
    document.getElementById("load").style.display = "flex";
    var userInput = document.getElementById('code-in').value;
    if (userInput === serverCode) {
        alert('Uspesna registracija!');
        window.location.href="/login";
        accept();
        //sendRequestFromJS2("GET", "http://127.0.0.1:8000/login");
    } else {
        alert('Registracija nije uspela.');
        window.location.href='/home';
        deleteUser();
        //sendRequestFromJS2("GET", "http://127.0.0.1:8000/home");
    }
}
    </script>
@endsection
</body>
</html>
