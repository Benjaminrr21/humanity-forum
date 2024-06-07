<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <style>
        p,h1 {
            background-color: white;
            color: black;

        }
    </style>
     <link rel="stylesheet" href="{{ asset('styles/topics.css') }}">

</html>
@extends('layout.index')
@section('content')


    <div id="content-outer">
        <div class="center2">
            @if($topic->isOpen==0)<span style="font-size: 1rem;" id="closed" ><i style="color: white;" class="ri-key-line"></i> Tema je zatvorena</span>@endif

            <div id="heading3">

                <h3>{{$topic->name}}</h3>
            </div>
            @if(Auth::user()&&Auth::user()->id==$topic->owner_id)
            <a style="width: 100%;" href="{{route("news2",['id'=>$topic->id])}}">
            <button class="blue-buttons" style="margin-bottom: 2rem;" id="my-users"><i class="ri-chat-4-line"></i> Obavesti pratioce</button>
            </a>
            @endif

            @if($topic->moderator->id == Auth::user()->id)
            <div id="options-outer">
            <div class="buttons2">
                
                @if($topic->isOpen == 1)
                 <form action="{{route('close-topic',['id'=>$topic->id])}}">
                    @csrf
                    <button onclick="closee(this)" type="submit" id="close-topic2"><i class="ri-close-line"></i> Zatvori temu</button>
                </form> 
                @else
                <form action="{{route('open-topic',['id'=>$topic->id])}}">
                    @csrf
                    <button onclick="openn()" type="submit" class="blue-buttons" id="my-users"><i class="ri-openai-line"></i> Otvori temu</button>
                </form> 
                @endif
                 <form action="{{route('my-users',['id'=>$topic->id])}}" method="GET">
                    @csrf
                    <button class="blue-buttons" type="submit" id="my-users"><i class="ri-user-follow-line"></i> Pratioci</button>
                </form> 
                @if($topic->polls->count()==0)
                 <form action="{{route('add-poll',['id'=>$topic->id])}}" method="GET">
                    @csrf
                    <button class="blue-buttons" type="submit" id="my-users"><i class="ri-newspaper-line"></i> Dodaj anketu</button>
                </form> 
                @else
                 <form action="{{route('poll',['id'=>$topic->id])}}" method="GET">
                    @csrf
                    <button class="blue-buttons" type="submit" id="my-users"><i class="ri-newspaper-line"></i> Anketa</button>
                </form> 
                @endif
                <form action="{{route('statistic',['id'=>$topic->id])}}" method="GET">
                    @csrf
                    <button class="blue-buttons" type="submit" id="my-users"><i class="ri-newspaper-line"></i> Statistika</button>
                </form> 
                 
            </div>
            <div>
            </div>
        </div>
        @else
        <div class="buttons2">
                
            @if($topic->polls->count() != 0 && Auth::user()->id==3)
            <form action="{{route('poll',['id'=>$topic->id])}}" method="GET">
                @csrf
                <button class="blue-buttons" type="submit" id="my-users"><i class="ri-newspaper-line"></i> Anketa</button>
            </form> 
            @endif 
        </div>

            @endif

            <div id="mainn">

                
                <div id="info">
                    <div id="info-img">
                        <div id="imgg" style="background-image: url({{$topic->moderator->photo}});"></div>
                    </div>
                    <div id="info-name">
                        <p>{{$topic->moderator->username}}</p>
                       
                    </div>
                </div>
                <div id="content">
                    
                    <p>
                        {{$topic->content}}


                    </p>
                    <p><a href='{{$topic->file_path}}'>{{substr($topic->file_path,25)}}</a></p>
                </div>
            </div>
            <div class="list-comments">
                
               @foreach($comments as $comm)
                <div id="mainn-comments" >

                    <div id="info">
                        <div id="info-img">
                            <div class="image-comment" id="imgg" style="background-image: url({{$comm->user->photo}});"></div>
                        </div>
                        <div id="info-name">
                            <p class="comment-name">{{$comm->user->username}}</p>
                            <p class="comment-name" id="time">{{$comm->created_at}}</p>
                        </div>
                    </div>
                    <div id="content-comments">
                        <p>
                            {{$comm->content}}
                        </p>
                    </div>
                    <div id="reactions" >
                        <div data-comment-id='{{$comm->id}}'>
                            <span id="l1" onclick="likeComment(this)"><i style="color: #1c4966;" id="like" class="ri-thumb-up-line"></i></span><span id="l">{{$comm->likes}}</span>
                            <span id="l2" onclick="dislikeComment(this)"><i style="color: #1c4966;" id="dislike" class="ri-thumb-down-line"></i></span><span id="d">{{$comm->dislikes}}</span>
                            </div>
                        
                        <span id="reply">
                            <form method="POST" action="{{route('add-reply',['cid'=>$comm->id,'uid'=>Auth::user()->id,'tid'=>$topic->id])}}">
                                @csrf
                                <input type="text" name='content' placeholder="Odgovori korisniku..."><button type="submit" id="my-users2"><i class="ri-reply-line"></i></button>
                            </form>
                        </span>
                        @if(Auth::user()->id == $comm->user->id)
                        <form method="POST" action="{{route('delete-comment',['id'=>$comm->id])}}">
                            @csrf
                            @method('DELETE')
                        <button type="submit" id="my-users3"><i class="ri-delete-bin-line"></i></button>
                        </form>
                        @endif
                        

                        
                    </div>
                    
                </div>
                @if($comm->replies->count() > 0)
                <div style="display: flex;justify-content:end;"><span id="repl">Odgovori</span></div>
                @foreach($comm->replies as $r)
                <div style="display: flex;justify-content:end;">
                <div id="mainn-comments2">
                    <div id="info">
                        <div id="info-name">
                            <p class="comment-name">{{$r->user->username}}</p>
                            <p class="comment-name" id="time">{{$r->created_at}}</p>
                        </div>
                    </div>
                    <div id="content-comments">
                        <p>
                            {{$r->content}}
                        </p>
                    </div>
                </div>
                </div>
                @endforeach
                @endif
                @endforeach
                @if(Auth::user() && Auth::user()->id != $topic->moderator->id)
                <div id="comment-box">
                    <form action="{{route('add-comment',['idTopic'=>$id,'idUser'=>Auth::user()->id])}}" method="POST">
                        @csrf
                        <p>
                            <span class="emoji">&#128512;</span>
                            <span class="emoji">&#128525;</span>
                            <span class='emoji'>&#128151;</span>
                            <span class='emoji'>&#128514;</span>
                            <span class='emoji'>&#128517;</span>
                            <span class='emoji'>&#128513;</span>
                            
                        </p>
                        <textarea name="comment" id="comment" cols="20" rows="3" placeholder="Dodaj komentar..."></textarea>                            
                        <div id='btn-comm'>
                            <button type="submit">Dodaj</button>
                        </div>
                    </form>
                    </div>
                    @endif
            </div>
            
        </div>
    </div>
    {{-- @if($topic->isOpen==1)
        <a href="{{route('close-topic',['id'=>$id])}}"><button type="submit">Zatvori temu</button></a>
    @else
        <p>Tema je zatvorena.</p>
        <a href="{{route('open-topic',['id'=>$id])}}"><button type="submit">Otvori temu</button></a>
    @endif

    <div style="width: 300px; height:300px; background-color:transparent;">
    hajajahdideieeie
    </div> --}}
    <script src='{{asset("javascript/topic.js")}}'>
        
    </script>
@endsection