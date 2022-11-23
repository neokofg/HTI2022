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
@foreach($team as $teams)
    <h2>Команда</h2>
    <img src="/images/{{$teams->image}}" style="width:100px;height:100px">
    <p>{{$teams->name}}</p>
    <p>{{$teams->description}}</p>
    @if(Auth::user()->id == $teams->leaderid)
        Заявки:
    @endif
@endforeach
</body>
</html>
