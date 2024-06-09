@extends('layout.index');
@section('content');
<html>
   

    <link rel="stylesheet" href="{{ asset('styles/topics.css') }}">
</html>
{{-- @push('styles')
    <link rel="stylesheet" href="{{ asset('styles/topics.css') }}">
@endpush --}}

<div id="content-outer">
    <div class="center">
        @if($topics->count()==0)
        <p>Nema otvorenih tema.</p>
        @else
    
         <div id="heading">Teme koje pratim</div>
        <span></span>
         <div class="list">
            @foreach($topics as $topic)
            <div class="item">
                <div id="main">
                    <h1>{{ $topic->name }}</h1>
                    <span><i class="ri-group-fill"></i> {{ $topic->followers->count() }}</span>
                </div>
                <div id="options">
                    <div id="btn-option">
                        <form method="POST" action="{{route('follow-topic',['idUser'=>Auth::user()->id,'idTopic'=>$topic->id])}}">
                            @csrf
                        </form>
                    </div>
                    <div id="btn-option">
                        <a href="{{ route('topic-id',['id'=>$topic->id]) }}"><button ><i class="ri-edit-2-line"></i> Uđi u temu</button></a>
                    </div>        
                        <div id="myModal" class="modal">
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
     var modal = document.getElementById("myModal");

var btn = document.getElementById("close-topic");

var span = document.getElementsByClassName("close")[0];

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

