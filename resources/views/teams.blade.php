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
<a href="{{route('index')}}">Назад</a>
<h2>Команды</h2>
@foreach($teams as $team)
    <div>
    <img src="/images/{{$team->image}}" style="width:100px;height:100px">
    <p>{{$team->name}}</p>
    <p>{{Str::limit($team->description, 50, ' ...')}}</p>
        <a href="{{route('team',['id' => $team->id])}}">Подробнее</a>
        <form action="{{route('requestToTeam')}}" method="POST">
            @csrf
            <input type="text" value="{{$team->id}}" name="teamid" style="display:none">
            <button>Подать заявку</button>
        </form>
    </div>
    <hr>
@endforeach
<a href="{{route('createteam')}}">Создать команду</a>
</body>
</html>
