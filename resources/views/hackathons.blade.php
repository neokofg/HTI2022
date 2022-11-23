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
<h1>Хакатон лист:</h1>
@foreach($hackathons as $hack)
    <img src="/images/{{$hack->image}}" style="width:150px;height:150px">
    <h3>{{$hack->name}}</h3>
    <p>{{$hack->prize}} руб.</p>
    <p>{{$hack->date}}</p>
    <a href="{{route('hackathon',['id' => $hack->id])}}"><button>Подробнее</button></a>
    <hr>
@endforeach
</body>
</html>
