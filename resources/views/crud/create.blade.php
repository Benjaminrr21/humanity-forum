<form action="{{route('add-topic-create',['id'=>(Auth::user()->id)+3])}}" method="post" class="form-group">
    @csrf
  <label for="name">Naziv teme</label>
  <input type="text" name="name" id="name" class="form-control" placeholder="Naziv..." >

  {{-- <label for="numOfFollowers">Broj pratioca</label>
  <input type="number" name="numOfFollowers" id="numOfFollowers" class="form-control"> --}}

  <button type="submit">Dodaj</button>
  
</div>