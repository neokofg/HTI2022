<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{route('hackathons')}}">Назад</a>
    @foreach($hackathon as $hack)
        <h2>{{$hack->name}}</h2>
        <img src="/images/{{$hack->image}}" style="width:500px;height:300px">
        <h3>{{$hack->prize}} руб.</h3>
        <p>{{$hack->description}}</p>
        <p>{{$hack->date}}</p>
    @endforeach
    <h2>Участники</h2>
    <ul>
    @foreach($team as $teamnames)
        <li>{{$teamnames->name}}</li>
    @endforeach
    </ul>
    <br>
    @if(Auth::check())
    <form action="{{route('participate')}}" method="POST">
        @csrf
        <input type="text" name="hackid" value="{{$hack->id}}" style="display:none">
        <button>Участвовать</button>
    </form>
    @endif
</body>
</html>
