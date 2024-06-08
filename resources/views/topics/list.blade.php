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
          <p  id="login-topics">Nema otvorenih tema.</p>
   
        @else
            <div id="heading">Sve teme</div>
            
            <div class="list">
            @foreach($topics as $topic)
            <div class="item">
                @if($topic->isOpen==0)<span id="closed" >Zatvorena</span>@endif
                <div id="main">
                    <h1>{{ $topic->name }}</h1>
                    
                    <span><i class="ri-group-fill"></i> {{ $topic->followers->count() }}</span>
                    <p>Moderator: <a style="color: #1c4966;" href='mailto:{{$topic->moderator->email}}'><b>{{$topic->moderator->username}}</b></a></p>
                    
                </div>
                <div id="options">
                    
                     @if(Auth::user() && Auth::user()->role_id==1)
                   {{--     @if(Auth::user()->following->contains($topic->id)) --}}
                            <div id="btn-option">   
                                <form  action="{{route('topic-id',['id'=>$topic->id])}}">
                                    @csrf
                                <button><i class="ri-edit-2-line"></i> Uđi u temu</button>
                                </form>
                            </div>
                        {{-- @else --}}
                        {{-- <div id="btn-option">   
                            <form method="POST" action="{{route('follow-topic',['idUser'=>Auth::user()->id,'idTopic'=>$topic->id])}}">
                                @csrf
                            <button><i class="ri-add-circle-fill"></i> Pridruži se temi</button>
                            </form>
                        </div> --}}
                       {{--  @endif--}}
                    @endif 
                    @if(Auth::user() && Auth::user()->role_id == 3)
                    @if(!Auth::user()->following->contains($topic->id))
                    <div id="btn-option">   
                        <form method="POST" action="{{route('follow-topic',['idUser'=>Auth::user()->id,'idTopic'=>$topic->id])}}">
                            @csrf
                        <button><i class="ri-add-circle-fill"></i> Pridruži se temi</button>
                        </form>
                    </div>
                    @else
                    <div id="btn-option">   
                        <form  action="{{route('topic-id',['id'=>$topic->id])}}">
                            @csrf
                        <button><i class="ri-edit-2-line"></i> Uđi u temu</button>
                        </form>
                    </div>
                    @endif
                    @endif
                
                    
                    
                </div>
                </div>
            @endforeach

            </div>
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

