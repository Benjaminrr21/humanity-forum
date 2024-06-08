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
    
         <div id="heading" style="color: white; padding:0.7rem; border-radius:15px;">Moje teme</div>
        
         <div class="list">
            @foreach($topics as $topic)
            <div class="item">
                @if($topic->isOpen==0)<span id="closed" ><i style="color: white;" class="ri-key-line"></i> Zatvorena</span>@endif

                <div id="main">
                    <h1>{{ $topic->name }}</h1>
                    <span><i style="color: #1c4966;" class="ri-group-fill"></i> {{ $topic->numOfFollowers }}</span>
                </div>
                
                <div id="options">
                    <div id="btn-option">
                        <form method="POST" action="{{route('follow-topic',['idUser'=>Auth::user()->id,'idTopic'=>$topic->id])}}">
                            @csrf
                        </form>
                    </div>
                    <div id="btn-option">
                        <a href="{{ route('topic-id',['id'=>$topic->id]) }}"><button><i class="ri-add-circle-fill"></i> Upravljaj temom</button></a>
                    </div> 
                    <div id="btn-option">
                        <form action="{{ route('deletetopic', ['id' => $topic->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button style="background-color: rgb(202, 140, 140); border:none; margin-left:0.2rem;" type="submit"><i class="ri-add-circle-fill"></i> Izbriši temu</button>
                        </form>
                    </div>
                   
                </div>   
                
                
            </div>    
                        {{-- <div id="myModal" class="modal">
                                aaa
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <p>Zatvaranje teme...</p>
                                </div>
                        </div> --}}
                  
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

