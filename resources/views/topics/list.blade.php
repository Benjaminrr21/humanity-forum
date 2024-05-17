@extends('layout.index');
@section('content');
<html>
   

    <link rel="stylesheet" href="{{ asset('styles/topics.css') }}">
</html>
{{-- @push('styles')
    <link rel="stylesheet" href="{{ asset('styles/topics.css') }}">
@endpush --}}
<div id="seriously" >
    <p>Zao nam je, niste registrovani.</p> 
    <button id="reg" class="acc2" id="acc"><a href="{{route('registration')}}">Registruj se</a></button>
    <button class="acc2" onclick="hide()">U redu</button>
</div>
<div id="content-outer">
    
    <div class="center">
        
        @if($topics->count()==0)
          @if(Auth::user() && (Auth::user()->role_id == 3 || Auth::user()->role_id==1))
          <p id="login-topics">Nema otvorenih tema.</p>

          @else
          <div class="stand">
          <p id="standp">Nemate otvorenih tema.</p>
          <button id="open-topic"><a href='/add-topic'>Otvori temu</a></button>
          </div>
          @endif
        @else
        @if(Auth::user() && Auth::user()->role_id == 1)
        <div id="heading">Sve teme</div>
        @else
        <div id="heading">Otvorene teme</div>
        @endif
         <div class="list">
            @foreach($topics as $topic)
            <div class="item">
                <div id="main">
                    <h1>{{ $topic->name }}</h1>
                    <span><i class="ri-group-fill"></i> {{ $topic->followers->count() }}</span>
                    @if(Auth::user() && Auth::user()->role_id == 1)
                    <p>Moderator: <a style="color: #1c4966;" href='mailto:{{$topic->moderator->email}}'><b>{{$topic->moderator->username}}</b></a></p>
                    @endif
                </div>
                <div id="options">
                    @if(Auth::user() && Auth::user()->role_id==3)

                    <div id="btn-option">
                        @if($topic->followers->contains(Auth::user()->id))
                        <form  action="{{route('topic-id',['id'=>$topic->id])}}">
                            @csrf
                        <button><i class="ri-edit-2-line"></i> Uđi u temu</button>
                        </form>
                        <form  action="{{route('poll',['id'=>$topic->id])}}">
                            @csrf
                        <button><i class="ri-edit-2-line"></i> Odradi anketu</button>
                        </form>
                        @else
                        <form method="POST" action="{{route('follow-topic',['idUser'=>Auth::user()->id,'idTopic'=>$topic->id])}}">
                            @csrf
                        <button><i class="ri-add-circle-fill"></i> Pridruži se temi</button>
                        </form>
                        
                       @endif
                       
                    </div>
                    @endif
                    @if($topic->owner_id == Auth::user()->id)
                    <div id="btn-option">
                        <a href="{{ route('topic-id',['id'=>$topic->id]) }}"><button ><i class="ri-add-circle-fill"></i> Upravljaj temom</button></a>
                    </div> 
                    @endif
                    {{-- @else --}}
                   {{--  <div id="btn-option">
                            @csrf
                        <button onclick="notRegister()"><i class="ri-add-circle-fill"></i> Pridruži se temi</button>
                    </div> --}}
                    {{-- <div id="btn-option">
                        <a href="{{ route('topic-id',['id'=>$topic->id]) }}"><button ><i class="ri-add-circle-fill"></i> Upravljaj temom</button></a>
                    </div>  --}}
{{--                     @endif   
 --}}                        <div id="myModal" class="modal">
                                aaa
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <p>Zatvaranje teme...</p>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            @endforeach
             
        </div>
        @endif
    </div>
</div>

<script>
    console.log($0);
    function hide(){
        document.getElementById("seriously").style.display = 'none';
    }
     var modal = document.getElementById("myModal");

var btn = document.getElementById("close-topic");

var span = document.getElementsByClassName("close")[0];

function notRegister(){
    document.getElementById("seriously").style.display = 'block';
    
}
btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 
</script>
@endsection

