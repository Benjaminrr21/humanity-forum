<table>
    <tr>
        <th>Ime</th>
        <th>Slika</th>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{$user->firstname}}</td>
        <td><img src="{{asset($user->photo)}}" alt="slika" width="200px" height="200px"></td>
    </tr>    
    @endforeach
    
</table>