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
<div>Команды</div>
@foreach($teams as $team)
    <div>
    <img src="/images/{{$team->image}}" style="width:100px;height:100px">
    <p>{{$team->name}}</p>
    <p>{{Str::limit($team->description, 50, ' ...')}}</p>
    </div>
    <hr>
@endforeach
<a href="{{route('createteam')}}">Создать команду</a>
</body>
</html>
