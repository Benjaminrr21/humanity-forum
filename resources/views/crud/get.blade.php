<ul>
     @foreach ($topics as $topic) 
        <li>{{$topic->name}}</li><button>{{$topic->numOfFollowers}}</button>
     
    @endforeach
</ul>